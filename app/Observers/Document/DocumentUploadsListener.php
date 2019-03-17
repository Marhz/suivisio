<?php

namespace App\Observers\Document;

use App\Events\Document\DocumentUploadsEvent;
use App\Notifications\Document\DocumentUploadsNotification;
use Notification;

class DocumentUploadsListener
{
  public function handle(DocumentUploadsEvent $event)
  {
    Notification::send($event->user->group->teachers, new DocumentUploadsNotification($event));
  }
}
