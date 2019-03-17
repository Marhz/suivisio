<?php

namespace App\Notifications\Document;

use App\Mails\Document\TeacherAcceptsMail;
use App\Notifications\MyNotification as Notification;

class TeacherAcceptsNotification extends Notification
{
    public $document;

    public function __construct($event)
    {
      parent::__construct('documents.notifications.accepts', '/documents/'.$event->document->id);
      $this->document = $event->document;
      $this->data['user'] = $event->user->id;
      $this->data['document'] = $event->document->id;
      $this->data['document_name'] = $event->document->name;
    }

    public function getMail($recipient){return new TeacherAcceptsMail($this, $recipient);}
}
