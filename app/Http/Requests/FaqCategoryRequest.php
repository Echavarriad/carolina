<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqCategoryRequest extends FormRequest
{  
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'title'=>'required'
        ];
        
        return $rules;        

    }

    public function messages(){      
        return [
            'title.required'=>'La categoría es requerida'
        ];
    }   

}

