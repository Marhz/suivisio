<?php

namespace App\Notifications\Document;

use App\Mails\Document\DocumentUploadsMail;
use App\Notifications\MyNotification as Notification;

class DocumentUploadsNotification extends Notification
{
    public $user, $document;

    public function __construct($event)
    {
      parent::__construct('documents.notifications.uploads', '/documents/'.$event->document->id);
      $this->user = $event->user;
      $this->document = $event->document;
      $this->data['user_name'] = $event->user->fullName();
      $this->data['group'] = $event->user->group->id;
      $this->data['document'] = $event->document->id;
      $this->data['document_name'] = $event->document->name;
    }

    public function getMail($recipient){return new DocumentUploadsMail($this, $recipient);}
}
