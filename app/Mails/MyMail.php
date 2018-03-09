<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $notification;
    protected $recipient;

    public function __construct($notification, $recipient)
    {
        $this->notification = $notification;
        $this->recipient = $recipient;
    }

    public function build()
    {
        return $this
          ->view($this->view)
          ->subject($this->subject)
          ->with(
            [
              'recipient' => $this->recipient,
              'notification' => $this->notification
            ]);
    }
}
