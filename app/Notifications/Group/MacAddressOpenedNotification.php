<?php

namespace App\Notifications\Groups;

use App\Mails\Groupss\MacAddressOpenedMail;
use App\Notifications\MyNotification as Notification;

class MacAddressOpenedNotification extends Notification
{
    private $group;

    public function __construct($group)
    {
      parent::__construct('groups.notifications.macAddressOpened', '/macAddress');
      $this->data['group'] = $group->id;
      $this->data['mac_address_deadline'] = $group->mac_address_deadline;
      dd('group udpated');
    }

    public function getMail($recipient){return new MacAddressOpenedMail($this, $recipient);}
}
