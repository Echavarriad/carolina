<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
{  
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'code_city'=>'required', 
            'code_state'=>'required', 
            'value_min_buy'=>'required', 
            'shipping_fee'=>'required'
        ];
        
        return $rules;        

    }

    public function messages(){      
        return [
            'code_state.required' => 'Seleccione el departamento',
            'code_city.required' => 'Seleccione la ciudad',
            'value_min_buy.required' => 'Ingrese el valor mínimo de compra',
            'shipping_fee.required' => 'Ingrese el valor del flete',
        ];
    }   

}

