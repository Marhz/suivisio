<?php

namespace App\Policies;

use App\User;
use App\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
    }

    public function view(User $user)
    {
        return $user->isTeacher();
    }

    public function edit(User $user, Group $group)
    {
        return $this->view();
    }
}
