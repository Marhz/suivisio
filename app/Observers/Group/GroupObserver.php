<?php

namespace App\Observers\Group;

use Notification;
use Carbon;

use App\Models\Group;
use App\Notifications\Group\MacAddressOpenedNotification;
use App\Notifications\Group\GroupOpenedNotification;

class GroupObserver
{
    public function updated(Group $group)
    {
        $this->macAddressOpened($group);
        $this->opened($group);
    }

    private static function datesEgales($date1, $date2)
    {
      return (new Carbon($date1))->diffInDays(new Carbon($date2)) == 0;
    }

    private function macAddressOpened(Group $group)
    {
      if(!self::datesEgales($group->mac_address_deadline, $group->getOriginal()['mac_address_deadline']))
        Notification::send($group->getUsers(), new MacAddressOpenedNotification($group));
    }

    private function opened(Group $group)
    {
      if(!self::datesEgales($group->deadline, $group->getOriginal()['deadline']))
        Notification::send($group->users, new GroupOpenedNotification($group));
    }
}
