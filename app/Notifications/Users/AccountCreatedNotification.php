<?php

namespace App\Notifications\Users;

use App\Mails\Users\AccountCreatedMail;
use App\Notifications\MyNotification as Notification;


class AccountCreatedNotification extends Notification
{
    private $user;
    private $password;

    public function __construct($user, $password)
    {
      parent::__construct('users.notifications.created', '/users/'.$user->id.'/edit');
      $this->data['password'] = $password;
      $this->password = $password;
      $this->data['user'] = $user->id;
      $this->user = $user;
    }

    public function getMail($recipient){return new AccountCreatedMail($this, $recipient);}
}
