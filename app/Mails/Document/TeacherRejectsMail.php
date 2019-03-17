<?php

namespace App\Mails\Document;

use App\Mails\MyMail;

class TeacherRejectsMail extends MyMail
{
  public function __construct($notification, $recipient)
  {
    parent::__construct($notification, $recipient);
    $this->subject = 'Refus de '.$notification->document->name;
    $this->view = 'documents.mails.rejects';
  }
}
