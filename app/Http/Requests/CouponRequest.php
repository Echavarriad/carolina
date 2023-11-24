<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{  
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'name'  => 'required',
            'code'  => 'required|unique:coupons,code',
            'start' => 'required',
            'end'   => 'required|after_or_equal:start'
        ];

        if(request()->limited){
            $rules['quantity']= 'required|numeric';
        }

        if(request()->type_discount == 'percent'){
            $rules['discount']= 'numeric|min:1|max:100';
        }

        if($this->method() == 'POST'){
            $rules['code'] = 'unique:coupons';
        }

        if($this->method() == 'PUT'){
            $rules['code'] = 'required|unique:coupons,code,' . request()->id;
        }
    
        return $rules;        

    }

    public function messages(){      
        return [
            'name.required' => 'El nombre del cupón es requerido',
            'code.required' => 'El código del cupón es requerido',
            'code.unique' => 'El código del cupón ya existe',
            'start.required' => 'La fecha inicial es requerida',
            'end.required' => 'La fecha final es requerida',
            'end.after_or_equal' => 'La fecha final debe ser una fecha posterior a la fecha inicial',
            'quantity.required' => 'La cantidad es requerida',
            'quantity.numeric' => 'La cantidad debe ser numérica',
            'discount.min' => 'El descuento mínimo debe ser mayor a 0',
            'discount.max' => 'El descuento no puede ser mayor a 100',
            'discount.numeric' => 'El descuento debe ser un número',
        ];
    }   

}

