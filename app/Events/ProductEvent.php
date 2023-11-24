<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductEvent
{

 	use Dispatchable, InteractsWithSockets, SerializesModels;
	public $product;
	
	function __construct($product)
	{
			$this->product = $product;
	}
	
}