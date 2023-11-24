<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{  
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules=[];

        if($this->method() == 'POST'){
            $rules['name'] = 'required';
            $rules['email'] = 'required|email';
            $rules['phone'] = 'required';
            $rules['message'] = 'required';
        }
    
        return $rules;        

    }

    public function messages(){      
        return [
            'name.required' => __('messages.required_name'),
            'email.required' => __('messages.required_email'),
            'email.email' => __('messages.email_invalid'),   
            'phone.required' => __('messages.required_phone'),
            'message.required' => __('messages.required_message')
        ];
    }   

}

