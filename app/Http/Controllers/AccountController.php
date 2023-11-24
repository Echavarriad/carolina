<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{Event};
use App\Http\Controllers\GeneralController;
use App\Mail\{ForgotPasswordMail};
use App\Models\{State, User, City, CustomerAddress};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use Cart;

class AccountController extends GeneralController {

    public function login(){
        set_content(7);
        
        $previous = url()->previous();
        if ($previous == route('account.change_password')) {
            $previous = route('home');
        }

        return view('account.login', compact('previous'));
    }

    public function register(){  
        set_content(7);
        $previous = url()->previous();

        return view('account.register', compact('previous'));
    }

    public function forgot_password(){

      return view('account.forgot_password');
    }

    public function change_password(){   

      return view('account.change_password');
    }


    public function home(Request $request){ 
        set_content(7);   
        $documents = ['Cédula de ciudadanía', 'NIT'];
        $user = User::with(['orders'])->find(auth()->id());

        return view('account.home', compact('user', 'documents'));
    }

    public function address(){  
      set_content(7);        
      $states = State::order()->get();

      return view('account.address', compact('states'));
        
    }
}
