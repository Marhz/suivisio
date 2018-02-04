<?php

namespace App\Events\Users;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserCreatedEvent
{
    use InteractsWithSockets, SerializesModels;

    private $user ;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
      return $this->user;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
