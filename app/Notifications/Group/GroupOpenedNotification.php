<?php

namespace App\Notifications\Group;

use App\Mails\Groups\MacAddressOpenedMail;
use App\Notifications\MyNotification as Notification;

class MacAddressOpenedNotification extends Notification
{
    private $group;

    public function __construct($group)
    {
      parent::__construct('groups.notifications.macAddressOpened', '/macAddress');
      $this->data['group'] = $group->id;
      $this->data['mac_address_deadline'] = $group->mac_address_deadline;
    }

    public function getMail($recipient){return new MacAddressOpenedMail($this, $recipient);}
}
