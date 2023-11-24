<?php 

namespace App\Http\Controllers\Auth;

use App\Events\UpdateLastLogin;
use App\Http\Controllers\Controller;
use App\Shop\Facades\Favorite;
use Auth;

class CustomerLoginController extends Controller{

    public function login() {
        $credentials = request()->all();
        if (Auth::attempt($credentials)) {
        	$user = Auth::user();
        	event(new UpdateLastLogin($user));
            Favorite::putFavoritesToTableInBD();
            //Cart::updateCartLogin();  
            Favorite::forgetSesionFavorites();
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false, 'message' => __('content_vue.password_incorrect')]);
    }

    public function logout() {
        Favorite::putFavoritesToSession();
        auth()->guard('web')->logout();

        return redirect()->route('login');
    }
}