<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Event};
use App\Models\{Product, User, CustomerAddress, State, City, Module as TableModule};
use App\Shop\Repositories\{UserRepository, OrderRepository};
use App\Shop\{Coupon, Module};
use App\Shop\Facades\Cart;
/**
 * 
 */
class CheckoutController extends Controller
{	
    protected $orderRepository;
    
    public function __construct(OrderRepository $orderRepository){
        $this->orderRepository = $orderRepository;
    }
	public function user_cart() {        
        $user = User::where('id', auth()->user()->id)->with('address')->first(); 
       	UserRepository::fillUserCart($user);
        return response()->json(['status' => true, 'user' => $user]);
    }

    public function change_address_cart(){
    	$data = request()->all();
    	$address = CustomerAddress::where('id', $data['id'])->first();
		if(!empty($address)){
			$dataAddress = [
                'name_address' => $address->name_address,
                'address' => $address->address,
                'complement' => $address->complement,
                'state_id' => $address->state_id,
                'state' => $address->state()->first()->name,
                'city_id' => $address->city_id,
                'city' => $address->city()->first()->name,
                'code_dane' => $address->city()->first()->code,
                'name_person' => $address->name_person,
            ];
            Cart::setAddress($dataAddress);
            $cart = Cart::getCart();             
            $cart->update(['store_pickup' => 0]);

        }
        
        return response()->json(['status' => true]);       
    
    }

    public function apply_coupon(Coupon $coupon){
        $data = request()->all();
        $result = $coupon->redeem($data['code']);

        return response()->json(['status' => $result, 'message' => $coupon->getMessage()]);
    }

    public function remove_coupon(){
        Cart::removeCoupon();

        return response()->json(['status' => true, 'message' => 'Cupón eliminado con éxito']);
    }

    public function validate_email(){
        $data = request()->all();
        if ($user = User::whereEmail($data['email'])->first()) {
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);
    }

    public function buy_customer_guest(){
        $data = request()->all();
        $user = (Object) $data;
        if ($data['newsletter']) {
            Event::dispatch('user.newsletter', $user);
        }
        $state = State::find($data['state_id']);
        $city = City::find($data['city_id']);       
        $dataAddress = [
            'address' => $data['address'],
            'complement' => $data['complement'],
            'code_dane' => $city->code,
            'state_id' => $state->id_state,
            'state' => $state->name,
            'city_id' => $data['city_id'],
            'city' => $city->name,
        ];
        Cart::setAddress($dataAddress);
        $dataCustomer = [
            'customer_email' => $data['email'],
            'customer_name' => $data['name'],
            'customer_lastname' => $data['lastname'],
            'customer_document' => $data['document'],
            'customer_type_document' => $data['type_document'],
            'customer_mobile' => $data['mobile'],
            'is_guest'      => 1
        ];
        Cart::setCustomer($dataCustomer);

        return response()->json(['status' => 'save']);
    }

    public function payment_method(){
        $data = request()->all();
        $cart = Cart::getCart();
        $payment_against_delivery = $data['payment_method'] == 'wompi' ? false : true;
        $payment_method = $data['payment_method'] == 'wompi' ? 'Wompi' : 'Contraentrega';
        $cart->update(['payment_against_delivery' => $payment_against_delivery, 'payment_method' => $payment_method]);
        
        return response()->json(['status' => true]);

    }

    public function calculate_shipping(){
        $address = Cart::getAddress();
        $carrier = Module::carriers($address);
        if(!$carrier->success){
            Cart::setShipping($carrier);  
            return response()->json(['status' => false, 'message' => 'Por el momento no tenemos envíos a la ciudad ingresada.']);   
        }

        Cart::setShipping($carrier);  

        return response()->json(['status' => true, 'carrier' => $carrier]);
    }

    public function update_info_shipping(){
        $cart=  Cart::getCart();
        $cart->grand_total= $cart->grand_total - $cart->shipping_rate;
        $cart->shipping_description= NULL;
        $cart->shipping_method= NULL;
        $cart->shipping_rate= 0;
        $cart->save();
    }

    public function continue_purchase(){
        $data = request()->all();
        if (Cart::hasError()) {
            return response()->json(['status' => false, 'message' => 'Algunos de los productos ya no se encuentran disponibles.']);
        }
        $user = User::where('id', auth()->user()->id)->with('address')->first();
        $response = Cart::setPackages((object) $data);
        if ($response) {
            $gateway = Module::gateways();
            if (empty($gateway)) {
               $response = ['status' => false, 'message' => 'No hay métodos de pago disponibles.'];
            }else{             
                $response = ['status' => true, 'gateway' =>  $gateway];
            }
        }else{
            $response = ['status' => false, 'message' => 'Ocurrió un error inesperado, intente nuevamente'];
        }

        return response()->json($response);
    } 

    public function finalize_purchase(){
        $data = request()->all();
        if (Cart::hasError()) {
            abort(400);
        }
        $module = TableModule::where('code', $data['code'])->first();
        $data['name'] = $module->name;
        Cart::setPaymentMethod($data);
        if ($module->type_payment == 'out_site') {
           $order = $this->orderRepository->create(Cart::prepareDataForOrder());
            $payment = Module::gateway($data['id'], $order);
            if (empty($payment)) {
                $response = ['status' => false, 'message' => 'An error occurred while processing the shipment'];
            }else{
                $response = ['status' => true, 'payment' => $payment];
                Event::dispatch('order.created', $order);
                Cart::removeCart();
            }
        }
        
        return response()->json($response);
    }

    
}