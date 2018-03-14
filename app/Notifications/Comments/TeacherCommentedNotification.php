<?php

namespace App\Notifications\Comments;

use App\Mails\Comments\TeacherCommentedMail;
use App\Notifications\Comments\CommentNotification as Notification;

class TeacherCommentedNotification extends Notification
{
    private $comment;

    public function __construct($comment)
    {
      parent::__construct($comment, 'comment.notifications.teacherCommented');
    }

    public function getMail($recipient){return new TeacherCommentedMail($this, $recipient);}
}
