<?php

namespace App\Mails\Users;

use App\Mails\MyMail;
use App\Models\User;

class AccountCreatedMail extends MyMail
{
  public function __construct($notification, $recipient)
  {
    parent::__construct($notification, $recipient);
    $this->subject = 'Votre compte a été créé';
    $this->view = 'users.mails.created';
  }
}
