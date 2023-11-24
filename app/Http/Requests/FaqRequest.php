<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{  
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'question'=>'required', 
            'answer'=>'required', 
        ];
        
        return $rules;        

    }

    public function messages(){      
        return [
            'question.required'=>'La pregunta es requerida',
            'answer.required'=>'La respuesta es requerida'
        ];
    }   

}

