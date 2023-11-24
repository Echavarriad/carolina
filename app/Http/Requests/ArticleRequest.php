<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{  
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'title'=>'required', 
            'text_single_top'=>'required', 
        ];

        if($this->method() == 'POST'){
            $rules['slug'] = 'unique:articles';
        }

        if($this->method() == 'PUT'){
            $rules['slug'] = 'unique:articles,slug,'.request()->id;
        }
        
        return $rules;        

    }

    public function messages(){      
        return [
            'title.required'=>'El título es requerido',
            'text_single_top.required'=>'El Texto ampliación sobre la galería es requerido',
            'slug.unique'=>'La URL para SEO debe ser única',
        ];
    }   

}

