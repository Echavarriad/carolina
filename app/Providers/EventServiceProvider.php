<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\UpdateLastLogin::class => [
            \App\Listeners\UpdateLastLogin::class
        ], 
        \App\Events\ChangeStatusDevolution::class => [
            \App\Listeners\ChangeStatusDevolution::class,
        ],
         \Illuminate\Auth\Events\Logout::class => [
            \App\Listeners\LogoutUser::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Event::listen('product.updated', 'App\Listeners\ProductListener@updated');
        Event::listen('order.created', 'App\Listeners\Order@created');
        Event::listen('order.paid', 'App\Listeners\Order@paid');
        Event::listen('order.declined', 'App\Listeners\Order@declined');
        Event::listen('order.send', 'App\Listeners\Order@send');
        Event::listen('user.registered', 'App\Listeners\UserRegistered@registered');
        Event::listen('user.newsletter', 'App\Listeners\UserRegistered@newsletter');
    }
}
