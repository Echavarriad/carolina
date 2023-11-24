<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPaid
{

 	use Dispatchable, InteractsWithSockets, SerializesModels;
	public $order;
	
	function __construct($order)
	{
		$this->order = $order;
	}
	
}