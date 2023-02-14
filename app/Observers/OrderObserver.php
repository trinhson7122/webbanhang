<?php

namespace App\Observers;

use App\Enums\OrderStatus;
use App\Events\LoadApp;
use App\Jobs\OrderStoredSendMailJob;
use App\Jobs\SendEmailJob;
use App\Models\Order;
use Illuminate\Support\Facades\Notification;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        event(new LoadApp());
        //Notification::send(auth()->user(), new OrderStoredNotificationMail($order));
        dispatch(new OrderStoredSendMailJob($order));
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        event(new LoadApp());
        if($order->status != OrderStatus::Cancelled){
            dispatch(new SendEmailJob($order));
        }
        //Notification::send(auth()->user(), new OrderUpdatedNotificationMail($order));
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
