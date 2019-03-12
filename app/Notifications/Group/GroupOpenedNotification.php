<?php

namespace App\Notifications\Group;

use App\Mails\Groups\GroupOpenedMail;
use App\Notifications\MyNotification as Notification;

class GroupOpenedNotification extends Notification
{
    public function __construct($group)
    {
      parent::__construct('groups.notifications.opened', '/groups/'.$group->id);
      $this->data['group'] = $group->id;
      $this->data['deadline'] = $group->deadline;
    }

    public function getMail($recipient){return new GroupOpenedMail($this, $recipient);}
}
