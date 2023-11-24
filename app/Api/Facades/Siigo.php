<?php 

namespace App\Api\Facades;

use Illuminate\Support\Facades\Facade;

class Siigo extends Facade
{
	protected static function getFacadeAccessor(){
      return 'siigo';
  }
	
}
