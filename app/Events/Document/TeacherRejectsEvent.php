<?php

namespace App\Events\Document;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TeacherRejectsEvent
{
    use InteractsWithSockets, SerializesModels;

    public $user, $document, $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $document, $comment)
    {
      $this->user = $user;
      $this->document = $document;
      $this->comment = $comment;
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
