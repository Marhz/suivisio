<?php

namespace App\Mails\Comments;

use App\Mails\MyMail;
use App\Models\Comment;

class StudentCommentedMail extends MyMail
{
  public function __construct($notification, $recipient)
  {
    parent::__construct($notification, $recipient);
    $this->subject = 'Commentaire sur votre situation professionnelle';
    $this->view = 'comments.mails.studentCommented';
  }
}
