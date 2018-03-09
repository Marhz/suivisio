<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Situation;
use Illuminate\Auth\Access\HandlesAuthorization;

class SituationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Situation $situation)
    {
        return $user->isTeacher() || $user->owns($situation);
    }

    public function edit(User $user, Situation $situation)
    {
        return $user->owns($situation) && $user->isOpened();
    }

    public function delete(User $user, Situation $situation)
    {
        return $user->owns($situation) && $user->isOpened();
    }
}
