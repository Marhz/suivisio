<?php

namespace App\Observers\Comments;

use App\Notifications\Comments\TeacherCommentedNotification;
use App\Notifications\Comments\StudentCommentedNotification;
use App\Models\Comment;
use Auth;
use Notification;

class CommentObserver
{
    public function updated(Comment $comment)
    {
      if ($comment->user == $comment->situation->user)
        $this->studentCommented($comment);
      else
        $this->teacherCommented($comment);
    }

    private function studentCommented($comment)
    {
      $teachers = $comment->situation->comments
        ->map(function ($comment, $key){return $comment->user;})
        ->filter(function ($commenter, $key)
          {return Auth::id() != $commenter->id && $commenter->isTeacher();})
        ->unique(function ($user, $key){return $user->id;});
      Notification::send($teachers, new StudentCommentedNotification($comment));
    }

    private function teacherCommented($comment)
    {
      $comment->situation->user->notify(new TeacherCommentedNotification($comment));
    }
}
