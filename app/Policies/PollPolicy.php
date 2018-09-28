<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MacAddress;
use Illuminate\Auth\Access\HandlesAuthorization;

class PollPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
      if (!config('app.enable_poll'))
        return false;
    }

    public function view(User $user)
    {
      return $user->isStudent()
        && $user->group->poll_deadline != null;
    }

    public function edit(User $user)
    {
      return $user->pollOpened();
    }
}
