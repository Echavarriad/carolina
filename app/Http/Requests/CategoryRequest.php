<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{  

	private $model = 'App\Models\Category';

  public function authorize(){
      return true;
  }


  public function rules(){
      $record = $this->model::find($this->category);
      $rules = [
          'name'=>'required', 
      ];

      if($this->method() == 'POST'){
      	$rules['slug'] = 'unique:categories';
      }

      if($this->method() == 'PUT'){
        $rules['slug'] = 'unique:categories,slug,'.$record->id;
      }

      return $rules;        

    }

    public function messages(){      
        return [
          'name.required' => 'El nombre de la categoría es requerido',
          'slug.unique'   => 'La URL para SEO debe ser única',
        ];

    }



   

}

