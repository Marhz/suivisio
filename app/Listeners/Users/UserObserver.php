<?php

namespace App\Listeners\Users;

use App\Models\User;
use Auth;
use App\Notifications\Users\AccountCreatedNotification;

class UserObserver
{
    public function created(User $user)
    {
      $user->passwordChanged = 0;
      $password = str_random(10);
      $user->password = bcrypt($password);
      $user->save();
      $user->notify(new AccountCreatedNotification($user, $password));
    }
}
