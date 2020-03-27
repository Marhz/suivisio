<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Group;
use App\Models\Year;
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
        return $user->isAdmin() ||
            $this->owns($user, $group) && $group->year->id == Year::current()->id;
    }

    public function delete(User $user, Group $group)
    {
        return $user->isAdmin();
    }

    public function edit(User $user, Group $group)
    {
      return $user->isAdmin() ||
          $this->owns($user, $group) && $group->year->id == Year::current()->id;
    }

    public function viewPDF(User $user, Group $group)
    {
      return $this->owns($user, $group);
    }

    public function viewMacAddresses(User $user, Group $group)
    {
      return config('app.collect_mac_addresses')
        && $this->view($user, $group)
        && $group->mac_address_deadline != null;
    }

    public function enableMacAddressesCollect(User $user)
    {
      return config('app.collect_mac_addresses')
        && $user->isTeacher();
    }

    public function viewPoll(User $user, Group $group)
    {
      return config('app.enable_poll')
          && $this->view($user, $group)
        && $group->poll_deadline != null;
    }

    public function enableCoursesPoll(User $user)
    {
      return config('app.enable_poll')
        && $user->isTeacher();
    }

    public function enableDocuments(User $user)
    {
      return config('app.enable_documents')
        && $user->isTeacher();
    }
}
