<?php

namespace App\Mails\Document;

use App\Mails\MyMail;

class DocumentUploadsMail extends MyMail
{
  public function __construct($notification, $recipient)
  {
    parent::__construct($notification, $recipient);
    $this->subject = $notification->user->fullName(). ' a déposé '.$notification->document->name.' sur Suivi Sio';
    $this->view = 'documents.mails.uploads';
  }
}
