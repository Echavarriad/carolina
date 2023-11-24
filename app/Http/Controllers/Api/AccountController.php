<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\City;
use App\Models\CustomerAddress;
use App\Models\State;
use App\Models\User;
use App\Shop\Facades\Cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

class AccountController extends Controller
{	
    public function create_account(){
        $data = request()->all();
        if ($user = User::where('email', $data['email'])->first()) {
            return response()->json(['status' => 'exists', 'message' => __('content_vue.email_is_registered')]);
        }
        $user = User::create($data);

        Event::dispatch('user.registered' , compact('user'));

        return response()->json(['status' => 'save', 'message' => __('content_vue.account_create')]);       
    } 

    public function update_account(){
        $data = request()->all();
        if (User::whereEmail($data['email'])->where('id', '!=', $data['id'])->first()) {
            return response()->json(['status' => false, 'message' =>  __('content_vue.email_is_registered_update')]);   
        }
        $object = User::findOrFail($data['id']);
        $object->fill(request()->all());
        $object->save();
        if (isset($data['newsletter']) && $data['newsletter']) {
            Event::dispatch('user.newsletter', $object);
        }
        if (isset($data['_checkout'])){
            $this->setAddressCustomerCart($data, $object->id);
        }

        return response()->json(['status' => 'update', 'message' =>  __('content_vue.info_update')]);   
    }

    public function forgot_password(){
        $data = request()->all();
        $user =  User::where('email', $data['email'])->first();
        if(!$user){
            return response()->json(['status' => 'error', 'message' => __('content_vue.email_not_registered')]);
        }
        $password_temporary = $this->getPasswordTemporary();
        $send =Mail::send(new ForgotPasswordMail($user, $password_temporary));
        if(!$send){
            return response()->json(['status' => 'not_send', 'message' => __('content_vue.error_send_password_forgot')]);
        }
        $user->changePassword(true, $password_temporary);
        $message= '<p style="color: #8c8c8c;font-size: 19px; text-align: inherit;">Se envió al correo <span style="font-weight:bold;color: '. config('settings.color_primary') . ';">' . $this->getReplaceEmail($data['email']) . '</span> la contraseña temporal para ingresar a la tienda.</p>';
        
        return response()->json(['status' => 'send', 'message' => $message]);       
    }

    public function change_password(){
        $data = request()->all();
        $user = User::find(auth()->id());
        if (!Hash::check($data['current_password'], $user->password)){
            return response()->json(['status' => 'error', 'message' => __('content_vue.password_current_invalid')]);  
        }
        $user->changePassword(false, $data['password']);
        auth()->guard('web')->logout();

        return response()->json(['status' => 'change', 'message' => __('content_vue.password_changed')]);

    }

    public function getAddressesByUser(){
        $user = User::find(auth()->id());
        $states = State::order()->get();
        foreach($user->address as  $item){
          $cities = City::where('state_id', $item->state_id)->get();
          $item->edit = false;
          $item->states = $states;
          $item->cities = $cities;
        }
        
        return response()->json(['addresses' => $user->address]);
    }

    public function create_address(){
        $data = request()->all();
        $response = $this->setSaveUpdateAddress($data, 'create');
        if($response['status'] == 'save'){
          $response['message'] = __('content_vue.address_save_success');
        }else{
          $response['message'] = __('content_vue.address_save_error');
        }

        return response()->json($response); 
    }

    public function update_address(){
        $data = request()->all();
        $response = $this->setSaveUpdateAddress($data, 'update');
        if($response['status'] == 'save'){
            $response['message'] = __('content_vue.address_update_success');
        }else{
            $response['message'] = __('content_vue.address_update_error');
        }
        
        return response()->json($response); 
    }

    public function delete_address($id){
        $object = CustomerAddress::find($id);
        if($object){
            $object->delete();
            if($object->principal){
                CustomerAddress::first()->update(['principal' => 1]);
            }
            $response = ['status' => true, 'message' => __('content_vue.address_delete_success')];
        }else{
          $response = ['status' => false, 'message' => __('content_vue.address_delete_error')];
        }
  
        return response()->json($response); 
  
      } 

    private function getReplaceEmail($email){
        $mail_segments = explode("@", $email);
        $lenght= strlen($mail_segments[0]);
        if($lenght == 1){
            return $email;
        }
        $show = $lenght >= 9 ? 3 :( $lenght <= 4 ? 1 : 2);
        $mail_segments[0] = substr($mail_segments[0],0, $show) . str_repeat("*", ($lenght - ($show * 2))) . substr($mail_segments[0], ($lenght - $show), $lenght);
    
        return implode("@", $mail_segments);

    }

    private function getPasswordTemporary(){
        return Str::random(7);
    }

    private function setSaveUpdateAddress($data, $action){
        
        $user = User::find(auth()->id());
        
        if($action == 'create'){
            unset($data['id']);
            $data['customer_id'] = $user->id;
            if($user->address->count() == 0){
                $data['principal']= true;
            }
            $create = CustomerAddress::create($data);
            if($create){
                $response = ['status' => 'save'];
            }else{
                $response = ['status' => 'error'];
            }
        }else{
            if($user->address->count() == 1){
                $data['principal']= true;
            }
            if($data['principal'] == 1){
                $user->address()->update(['principal' => 0]);
                CustomerAddress::find($data['id'])->update(['principal' => 1]);
            }
            unset($data['principal']);
            $update= CustomerAddress::find($data['id'])->update($data);
            if($update){
                $response = ['status' => 'save'];
            }else{
                $response = ['status' => 'error'];
            }
            
        }       

        return $response;
    }

    private function setAddressCustomerCart($data, $customer_id){
        $state = State::find($data['state_id']);
        $city = City::find($data['city_id']); 
        $dataAddress = [
            'address'     => $data['address'],
            'complement'  => $data['complement'],
            'code_dane'    => $city->code,
            'state_id'    => $state->id_state,
            'state'       => $state->name,
            'city_id'     => $data['city_id'],
            'city'        => $city->name,
        ];
        Cart::setAddress($dataAddress);
        $dataCustomer = [
            'customer_email'    => $data['email'],
            'customer_name'     => $data['name'],
            'customer_lastname' => $data['lastname'],
            'customer_document' => $data['document'],
            'customer_type_document' => $data['type_document'],
            'customer_mobile'    => $data['mobile'],
            'is_guest'          => 0,
            'customer_id'       => $customer_id
        ];
        
        if(auth()->check()){
            unset($data['email']);
            $user= User::find(auth()->user()->id);
            $user->update($data);
            if($user->address()->count() == 0){
                unset($dataAddress['state']);
                unset($dataAddress['city']);
                $dataAddress['name_address']= 'Principal';
                $dataAddress['principal']= true;
                $user->address()->create($dataAddress);
            }
        }
        Cart::setCustomer($dataCustomer);
    }
}