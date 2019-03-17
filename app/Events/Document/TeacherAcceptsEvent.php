<?php

namespace App\Events\Document;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TeacherAcceptsEvent
{
    use InteractsWithSockets, SerializesModels;

    public $user, $document;

  /**
     * Create a new event instance.
     *
     * @return void
     */
  public function __construct($user, $document)
  {
    $this->user = $user;
    $this->document = $document;
  }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
