<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name'=>'required',
        ];

        if($this->method() == 'POST' || !is_null(request()->image)){
          $rules['name'] = 'unique:products';
          $rules['slug'] = 'unique:products';
          $rules['sku'] = 'unique:products';
        }        

        if($this->method() == 'PUT'){
          $rules['name'] = 'required|unique:products,name,'.request()->id;
          $rules['slug'] = 'required|unique:products,slug,'.request()->id;
          $rules['sku'] = 'required|unique:products,sku,'.request()->id;
        }

        return $rules;       

    }

    public function messages(){      
        return [
          'name.required'=>'El nombre del producto es requerido',
          'name.unique'=>'El nombre del producto debe ser único',
          'slug.unique'=>'La URL para SEO debe ser única',
          'sku.required'=>'La referencia es requerida',
          'sku.unique'=>'La referencia ya existe, ingrese una referencia diferente por cada producto',
        ];

    }
}

