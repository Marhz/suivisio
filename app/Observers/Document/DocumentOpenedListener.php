<?php

namespace App\Observers\Document;

use App\Events\Document\DocumentOpenedEvent;
use App\Notifications\Document\DocumentOpenedNotification;
use Notification;

class DocumentOpenedListener
{
  public function handle(DocumentOpenedEvent $event)
  {
    Notification::send($event->group->users, new DocumentOpenedNotification($event));
  }
}
