<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{  
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'name'=>'required'
        ];

        if($this->method() == 'POST'){
            $rules['slug'] = 'unique:attributes';
        }

        if($this->method() == 'PUT'){
            $rules['slug'] = 'unique:attributes,slug,'.request()->id;
        }
        
        return $rules;        

    }

    public function messages(){      
        return [
            'name.required'=>'El nombre del atributo es requerido',
            'slug.unique'=>'La URL del atributo debe ser única',
        ];
    }   

}

