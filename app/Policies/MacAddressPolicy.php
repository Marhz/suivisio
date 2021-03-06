<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MacAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class MacAddressPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
      if (!config('app.collect_mac_addresses'))
        return false;
    }

    public function create(User $user)
    {
        return $user->isTeacher()
        || ($user->group->mac_address_deadline != null
          && $user->macAddressOpened()
          && $user->macAddresses->count() == 0);
    }

    public function view(User $user)
    {
      return $user->isTeacher()
      || $user->group->mac_address_deadline != null;
    }

    public function opened(User $user)
    {
      return $user->isTeacher()
      || $user->macAddressOpened();
    }

    public function edit(User $user, MacAddress $macAddress)
    {
        return $macAddress->user->id == $user->id && $user->macAddressOpened();
    }

    public function editLabel(User $user)
    {
        return $this->haveMany($user);
    }

    public function destroy(User $user, MacAddress $macAddress)
    {
        return $this->edit($user, $macAddress);
    }

    public function haveMany(User $authUser)
    {
        return $authUser->isTeacher();
    }
}
