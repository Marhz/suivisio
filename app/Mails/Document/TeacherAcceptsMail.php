<?php

namespace App\Mails\Document;

use App\Mails\MyMail;

class TeacherAcceptsMail extends MyMail
{
  public function __construct($notification, $recipient)
  {
    parent::__construct($notification, $recipient);
    $this->subject = 'Acceptation de '.$notification->document->name;
    $this->view = 'documents.mails.accepts';
  }
}
