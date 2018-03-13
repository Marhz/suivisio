<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isTeacher();
    }

    public function addSituation(User $user)
    {
        return $user->isOpened();
    }

    public function changerNumeroCandidat(User $user)
    {
        return $user->isOpened();
    }

    public function viewPDF(User $authUser, User $otherUser)
    {
        return $authUser->isAdmin()
          || $authUser->isTeacher()
          || $authUser->id == $otherUser->id;
    }

}
