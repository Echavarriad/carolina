<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateLastLogin
{

 	use Dispatchable, InteractsWithSockets, SerializesModels;
	public $user;
	
	function __construct($user)
	{
		$this->user = $user;
	}
	
}