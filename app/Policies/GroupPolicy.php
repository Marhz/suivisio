<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    private function owns($user, $group)
    {
        return $user->teacherOf->contains($group);
    }

    public function view(User $user, Group $group)
    {
        return $user->isAdmin() || $this->owns($user, $group);
    }

    public function delete(User $user, Group $group)
    {
        return $user->isAdmin();
    }

    public function edit(User $user, Group $group)
    {
      return $user->isAdmin() || $this->owns($user, $group);
    }

    public function viewPDF(User $user, Group $group)
    {
      return $this->owns($user, $group);
    }

    public function viewMacAddresses(User $user, Group $group)
    {
      return config('app.collect_mac_addresses')
        && $user->isTeacher()
        && $group->mac_address_deadline != null;
    }

    public function enableMacAddressesCollect(User $user, Group $group)
    {
      return config('app.collect_mac_addresses')
       && $user->isTeacher();
    }
}
