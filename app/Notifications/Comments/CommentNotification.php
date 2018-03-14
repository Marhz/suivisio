<?php

namespace App\Notifications\Comments;

use App\Notifications\MyNotification as Notification;

abstract class CommentNotification extends Notification
{
    private $comment;

    public function __construct($comment, $view)
    {
      parent::__construct($view, '/situation/'.$comment->situation->id);
      $this->data['situation'] = $comment->situation->id;
      $this->data['comment'] = $comment->id;
      $this->data['commenter'] = $comment->user_id;
      $this->data['student'] = $comment->situation->user_id;
      $this->comment = $comment;
    }

    public function getComment(){return $this->comment;}
}
