<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
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
        //установка рандомного пароля при добавлении нового пользователя
        User::creating(function($user){
            if($user->password === "" || empty($user->password)){
                $user->password  = bcrypt(Str::random(8));;
            }
        });
        Order::creating(function($order){
            if($order->creator_id === "" || empty($order->creator_id)){
                $order->creator_id  = Auth::id();
            }
        });
    }
}
