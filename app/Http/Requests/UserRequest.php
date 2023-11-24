<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
    private $model = 'App\Models\User';

    public function authorize() {
        return true;
    }

    public function rules() {
        $record = $this->model::find($this->user);
        $rules = [
              'name'=>'required',
        ];

        if($this->method() == 'POST'){
            $rules['email'] = 'required|email|unique:users';
            $rules['password'] = 'required';
            if (!empty(request()->password)) {
                $rules['_password_confirmation'] = 'required|same:password';
            }           
        }

      if($this->method() == 'PUT'){
            $rules['email'] = 'required|email|unique:users,email,'.$record->id;
      }

      return $rules;

    }



    public function messages() {
        return [
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'Ingrese un correo válido',
            'email.unique' => 'El correo ingresado ya está registrado',
            'password.required' => 'La contraseña es requerida',
            '_password_confirmation.same' => 'Las contraseñas no coinciden'
        ];

    }



}

