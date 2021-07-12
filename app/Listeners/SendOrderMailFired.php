<?php

namespace App\Listeners;

use PDF;
use Mail;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Events\SendOrderMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\AdminOrder\Http\Controllers\AdminOrderController;

class SendOrderMailFired
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
     * @param  SendOrderMail  $event
     * @return void
     */
    public function handle(SendOrderMail $event)
    {
        Mail::to($event->email)->send(new OrderMail($event->pdf));
    }
}
