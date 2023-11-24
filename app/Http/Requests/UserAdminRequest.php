<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Admin;

class UserAdminRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        $rules = [
              'name'=>'required',
              'document'=>'required',
              'establishment_id'=>'required',
              'city_id'=>'required',
        ];

        if($this->method() == 'POST'){
            $rules['email'] = 'required|email|unique:admins';           
        }

        if($this->method() == 'PUT'){
            $record = Admin::find(request()->id);
            $rules['email'] = 'required|email|unique:admins,email,'.$record->id;
        }

        return $rules;

    }



    public function messages() {
        return [
            'name.required' => 'El nombre es requerido',
            'document.required' => 'El documento es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'Ingrese un correo válido',
            'email.unique' => 'El correo ingresado ya está registrado',
            'establishment_id.required' => 'Seleccione el establecimiento',
            'city_id.required' => 'Seleccione la ciudad'
        ];

    }



}

