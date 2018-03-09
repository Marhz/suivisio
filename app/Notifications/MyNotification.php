<?php

namespace App\Notifications;

use Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

abstract class MyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $data;

    public function __construct($view, $url)
    {
      $this->data['url'] = $url;
      $this->data['view'] = $view;
    }

    public function via($recipient)
    {
        return env('MAIL_ENABLED')
          ? ['database', 'mail'] : ['database'];
    }

    public function toMail($recipient)
    {
      return $this
      	      ->getMail($recipient)
	            ->to($recipient);
    }

    public function toArray($recipient)
    {
        return $this->data;
    }

    public function getView(){return $this->data['view'];}

    public function getURL(){return $this->data['url'];}

    abstract public function getMail($recipient);
}
