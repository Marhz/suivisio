<?php

namespace App\Mails\Document;

use App\Mails\MyMail;

class DocumentOpenedMail extends MyMail
{
  public function __construct($notification, $recipient)
  {
    parent::__construct($notification, $recipient);
    $this->subject = 'Téléversez ' . $notification->data['document_name'] . ' sur Suivi Sio';
    $this->view = 'documents.mails.opened';
  }
}
