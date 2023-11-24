<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'image_1'=>'image|mimes:jpeg,bmp,png,svg|max:2200',
            'image_2'=>'image|mimes:jpeg,bmp,png,svg|max:2200',
            'image_3'=>'image|mimes:jpeg,bmp,png,svg,gif|max:10000',
            'image_4'=>'image|mimes:jpeg,bmp,png,svg|max:2200',
        ];

       /* if($this->method() == 'POST' || !is_null(request()->file))
          $rules['file'] = 'required|image|mimes:jpeg,bmp,png|max:2200';*/

        return $rules;

        
    }

    public function messages(){

        return [
          'image.mimes'=>'La imagen debe ser un archivo de tipo: :values',
          'image.image'=>'El archivo debe ser una imagen',
          'image.max'=>'El archivo debe pesar máximo 2 MB',
          'image_2.mimes'=>'La imagen debe ser un archivo de tipo: :values',
          'image_2.image'=>'El archivo debe ser una imagen',
          'image_2.max'=>'El archivo debe pesar máximo 2 MB',
          'image_3.mimes'=>'La imagen debe ser un archivo de tipo: :values',
          'image_3.image'=>'El archivo debe ser una imagen',
          'image_3.max'=>'El archivo debe pesar máximo 2 MB',
          'image_4.mimes'=>'La imagen debe ser un archivo de tipo: :values',
          'image_4.image'=>'El archivo debe ser una imagen',
          'image_4.max'=>'El archivo debe pesar máximo 2 MB',

        ];
    }

   
}
