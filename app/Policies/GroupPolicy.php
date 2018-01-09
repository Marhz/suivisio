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

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function delete(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Group $group)
    {
        return $user->isTeacher();
    }

    public function edit(User $user, Group $group)
    {
        return $this->view() && $user->teacherOf()->contains($group);
    }
}
