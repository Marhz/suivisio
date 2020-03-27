<?php

namespace App\Notifications\Document;

use App\Mails\Document\DocumentOpenedMail;
use App\Notifications\MyNotification as Notification;

class DocumentOpenedNotification extends Notification
{
    public $user, $document;

    public function __construct($event)
    {
      parent::__construct('documents.notifications.opened', '/documents/'.$event->document->id);
      $this->group = $event->group;
      $this->document = $event->document;
      $this->data['group'] = $event->group->id;
      $this->data['document'] = $event->document->id;
      $this->data['document_name'] = $event->document->name;
    }

    public function getMail($recipient){return new DocumentOpenedMail($this, $recipient);}
}
