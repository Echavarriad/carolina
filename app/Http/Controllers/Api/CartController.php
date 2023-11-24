<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Product, Variation};
use App\Shop\Coupon;
use App\Shop\Facades\Cart;
/**
 * 
 */
class CartController extends Controller
{	

    public function get_cart() {
        $cart = Cart::getCart();
        if ($cart != null) {
          $cart = $cart->formatted();
          $cart->count= Cart::count();
        }              

        return $cart;
    }

    public function validate_variation(){
      $data = request()->all();
      $variation = $this->getResultVariation($data);
      if ($variation) {
        if ($variation->price_special > 0) {
          $price = $variation->price_special;
          $price_special = core()->currency($variation->price);
        }else{
            $price = $variation->price;
            $price_special = '';
            $discount = '';
        }
        $variation->price = core()->currency($price);
        $variation->price_special = $price_special;
        $response = ['status' => true, 'variation' => $variation];
      }else{
          $response = ['status' => false, 'message' => __('content_vue.not_stock_variation_selected')];
      }
      return response()->json($response);
    }

		public function add_cart(){
        $data = request()->all();
        $result = true;
        $message = __('content_vue.not_stock');
        if (empty($data['quantity'])) {
          $data['quantity'] = 1;
        }
        $result = Cart::add($data);

        $response = ['status' => false, 'message' => $message];

        if ($result) {
          $response = [
            'status' => true,
            'product' => $result,
            'message' => __('content_vue.product_add_to_cart'),
            'url' => route('shop.cart')
          ];           
        }

        Cart::collectTotals();
        
        return response()->json($response);

    }

    public function remove_item($id){
      Cart::removeItem($id);
      Cart::collectTotals();

      return response()->json(['status' => 'remove', 'message' => __('content_vue.product_remove_cart')]);
    }

    public function update_item(Coupon $coupon){
      $data = request()->all();
      $item = Cart::getCart()->items->find($data['id']);
      if(!$item){
        return response()->json(['status' => false, 'message' => __('content_vue.item_not_exist_in_cart')]);
      }
      
      if (!Cart::updateItem($data['id'], $data, 'cart')) {
        return response()->json(['status' => false, 'message' => __('content_vue.not_stock')]);
      }else{
        if($item->quantity > $data['quantity']){
          $cart= Cart::getCart();
          if($cart->has_coupon){
            $result = $coupon->redeem($cart->coupon_code);
            if(!$result){
              Cart::removeCoupon();
            }
          }
        }
      }
      
      return response()->json(['status' => true]);
    }

    private function getResultVariation($data){
      $product_id= $data['product_id'];
      $array= explode('_', $data['values']);
      $variation= null;
      if(count($array) == 1){
        $comb= $data['values'];
        $variation = Variation::where('product_id', $product_id)->where('is_hidden', 0)->where('values', $comb)->first();
      }elseif(count($array) == 2){
        $comb= $data['values'];
        $variation = Variation::where('product_id', $product_id)->where('is_hidden', 0)->where('values', $comb)->first();
        if(!$variation){
          $comb= $array[1].'_'.$array[0];
          $variation = Variation::where('product_id', $product_id)->where('is_hidden', 0)->where('values', $comb)->first();
        }
      }elseif(count($array) == 3){
        $comb= $data['values'];
        $variation = Variation::where('product_id', $product_id)->where('is_hidden', 0)->where('values', $comb)->first();
        if(!$variation){
          $comb= $array[0].'_'.$array[2] .'_'.$array[1];
          $variation = Variation::where('product_id', $product_id)->where('is_hidden', 0)->where('values', $comb)->first();
          if(!$variation){
            $comb= $array[1].'_'.$array[0] .'_'.$array[2];
            $variation = Variation::where('product_id', $product_id)->where('is_hidden', 0)->where('values', $comb)->first();
            if(!$variation){
              $comb= $array[1].'_'.$array[2] .'_'.$array[0];
              $variation = Variation::where('product_id', $product_id)->where('is_hidden', 0)->where('values', $comb)->first();
              if(!$variation){
                $comb= $array[2].'_'.$array[0] .'_'.$array[1];
                $variation = Variation::where('product_id', $product_id)->where('is_hidden', 0)->where('values', $comb)->first();
                if(!$variation){
                  $comb= $array[2].'_'.$array[1] .'_'.$array[0];
                  $variation = Variation::where('product_id', $product_id)->where('is_hidden', 0)->where('values', $comb)->first();
                }
              }
            }
          }
        }
      }

      return $variation;
    }

   
}