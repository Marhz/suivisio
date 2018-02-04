<?php

namespace App\Listeners\Users;

use App\Events\Users\UserCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreatedListener
{
    public function handle(UserCreatedEvent $event)
    {
      $user = $event->getUser();
      $user->passwordChanged = 0;
      $password = str_random(10);
      $user->password = bcrypt($password);
      $user->save();
      $user->notify(new AccountCreatedNotification($user, $password));
    }
}
