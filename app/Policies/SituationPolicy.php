<?php

namespace App\Policies;

use App\User;
use App\Situation;
use Illuminate\Auth\Access\HandlesAuthorization;

class SituationPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function view(User $user, Situation $situation)
    {
        return true;//$user->isTeacher() || $user->owns($situation);
    }

    public function edit(User $user, Situation $situation)
    {
        return $user->owns($situation);
    }
}
