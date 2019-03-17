<?php

namespace App\Notifications\Document;

use App\Mails\Document\TeacherRejectsMail;
use App\Notifications\MyNotification as Notification;

class TeacherRejectsNotification extends Notification
{
    public $document;

    public function __construct($event)
    {
      parent::__construct('documents.notifications.rejects', '/documents/'.$event->document->id);
      $this->document = $event->document;
      $this->data['user'] = $event->user->id;
      $this->data['document'] = $event->document->id;
      $this->data['comment'] = $event->comment;
      $this->data['document_name'] = $event->document->name;
    }

    public function getMail($recipient){return new TeacherRejectsMail($this, $recipient);}
}
