<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNoty extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $event;
    public function __construct($event)
    {
    $this->event=$event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $dd($this->event);
        // return $this->view('view.name');
        return $this->view('user_email',['event'=> $this->event]);
    }
}
