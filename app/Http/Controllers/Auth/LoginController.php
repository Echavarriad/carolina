<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Cart;
class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm() {
        $section = Section::find(4);
        return view('auth.login', compact('section'));
    }
    
    public function logout() {
        Cart::forgetFavorites();        
        auth()->guard('web')->logout();
        return redirect('/login');
    }
}
