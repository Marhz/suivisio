<?php

namespace App\Observers\Document;

use App\Events\Document\TeacherRejectsEvent;
use App\Notifications\Document\TeacherRejectsNotification;

class TeacherRejectsListener
{
  public function handle(TeacherRejectsEvent $event)
  {
    $event->user->notify(new TeacherRejectsNotification($event));
  }
}
