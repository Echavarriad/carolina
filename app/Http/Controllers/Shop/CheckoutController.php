<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\GeneralController;
use App\Models\{State, User, City};
use App\Shop\{Module};
use App\Shop\Facades\Cart;
use App\Models\Module as ModuleTable;


class CheckoutController extends GeneralController
{
	
	public function cart(){    
      $cart = null;
      $departments = State::all();
      $user = User::where('id', auth()->id())->with('orders')->first();    
      if (Cart::exists()) {
          $cart = Cart::getCart()->formatted();
      }

      return view('shop.checkout.cart', compact('cart'));
	}

	public function checkout(){
    $cart = null;
		$address = null;
    if (Cart::exists()) {
        $cart = Cart::getCart()->formatted();
    }else{
      return redirect()->route('home');
    }
	 	$departments = State::all();
    $documents = ['Cédula de ciudadanía', 'NIT', 'Pasaporte'];
 	  if (!$user = auth()->user()) {
      $user = Cart::getUser();
      $address = Cart::getAddress();
    }else{      
      $address = $user->address->where('principal', 1)->first();
      if($address && !Cart::getAddress()){
        $user= User::find(auth()->user()->id);
        $address = $user->address->where('principal',1)->first();
        $state = State::find($address->state_id);
        $city = City::find($address->city_id);
        $dataAddress = [
          'address' => $address->address,
          'complement' => $address->complement,
          'code_dane' => $city->code,
          'state_id' => $address->state_id,
          'state' => $state->name,
          'city_id' => $address->city_id,
          'city' => $city->name,
        ];
        Cart::setAddress($dataAddress);
        $address = Cart::getAddress();
      }else{
        $address = Cart::getAddress();
      }
    }
		$breadcrumb = [
        array(
            'title'   => __('menu.cart'),
            'url'     => route('shop.cart')
        ),
        array(
            'title'   => __('menu.checkout'),
            'url'     => false
        )              
    ];
    
		return view('shop.checkout.checkout', compact('breadcrumb', 'cart', 'departments', 'user', 'address', 'documents'));
	}

  public function payment(){
    $cart = null;
    if (!Cart::exists()) {
      return redirect()->route('home');
    } 
    $cart = Cart::getCart()->formatted();
    $address = Cart::getAddress();    
    $gateways = Module::gateways();

    if (count($gateways) == 1) {
        $gateway = $gateways[0];
        $gateways[0]->switch = true;
    }
    $breadcrumb = [
          array(
              'title'   => __('menu.cart'),
              'url'     => route('shop.cart')
          ),
          array(
              'title'   => __('menu.checkout'),
              'url'     => route('shop.checkout')
          ),
          array(
              'title'   => __('menu.payment'),
              'url'     => false
          )               
    ];
    
    $can_continue = count($gateways) > 0 ? true : false;

    return view('shop.checkout.payment', compact('breadcrumb', 'cart', 'gateways',  'can_continue'));
  }


  public function return(){  
    set_content(9);
    $breadcrumb = [
          array(
              'title'   => __('menu.return'),
              'url'     => false
          )              
    ];  
    return view('shop.checkout.return', compact('breadcrumb'));
  }
}