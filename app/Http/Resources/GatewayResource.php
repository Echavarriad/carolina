<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class GatewayResource extends JsonResource
{
	
	 public function toArray($request)
    {
    	dd('Estoy en el resource');
      	return [
      		'id'					=> $this->id,
      		'name'				=> $this->name,
      		'description'	=> $this->description,
      		'logo' 				=> asset('uploads/' . $this->logo) 
      	];
    }
}