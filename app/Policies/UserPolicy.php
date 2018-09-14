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

    public function addSituation(User $authUser, User $otherUser)
    {
        return $authUser->id == $otherUser->id && $otherUser->isOpened();
    }

    public function editMacAddress(User $authUser)
    {
        return true;
    }

    public function haveMultipleMacAddresses(User $authUser)
    {
        return $authUser->isTeacher();
    }

    public function changerNumeroCandidat(User $user)
    {
        return $user->isOpened();
    }

    public function viewPDF(User $authUser, User $otherUser)
    {
        return $authUser->isTeacher()
          || $authUser->id == $otherUser->id;
    }

}
