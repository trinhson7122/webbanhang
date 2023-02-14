<?php

namespace App\Listeners;

use App\Events\UserStoredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendMailUserStoredNotification 
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserStoredEvent  $event
     * @return void
     */
    public function handle(UserStoredEvent $event)
    {
        //dd($event->user->name);
    }
}
