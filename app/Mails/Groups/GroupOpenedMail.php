<?php

namespace App\Mails\Groups;

use App\Mails\MyMail;
use App\Models\Group;

class GroupOpenedMail extends MyMail
{
  public function __construct($notification, $recipient)
  {
    parent::__construct($notification, $recipient);
    $this->subject = 'La saisie des situations professionnelles est ouverte';
    $this->view = 'groups.mails.opened';
  }
}
