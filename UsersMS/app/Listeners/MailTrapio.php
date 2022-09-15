<?php

namespace App\Listeners;

use App\Events\SendMailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


class MailTrapio implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(SendMailNotification $event)
    {
        // dd($event);
        Mail::to($event->user['email'])->send(new \App\Mail\MailNoty($event));
    }
}
