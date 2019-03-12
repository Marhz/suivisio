<?php

namespace App\Mails\Groups;

use App\Mails\MyMail;
use App\Models\Group;

class MacAddressOpenedMail extends MyMail
{
  public function __construct($notification, $recipient)
  {
    parent::__construct($notification, $recipient);
    $this->subject = 'La saisie des adresses mac est ouverte';
    $this->view = 'groups.mails.macAddressOpened';
  }
}
