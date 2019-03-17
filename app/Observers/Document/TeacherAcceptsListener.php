<?php

namespace App\Observers\Document;

use App\Events\Document\TeacherAcceptsEvent;
use App\Notifications\Document\TeacherAcceptsNotification;

class TeacherAcceptsListener
{
  public function handle(TeacherAcceptsEvent $event)
  {
    $event->user->notify(new TeacherAcceptsNotification($event));
  }
}
