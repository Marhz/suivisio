<?php

namespace App\Notifications\Comments;

use App\Mails\Comments\StudentCommentedMail;
use App\Notifications\Comments\CommentNotification as Notification;

class StudentCommentedNotification extends Notification
{
    private $comment;

    public function __construct($comment)
    {
      parent::__construct($comment, 'comment.notifications.StudentCommented');
    }

    public function getMail($recipient){return new StudentCommentedMail($this, $recipient);}
}
