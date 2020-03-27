<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Document;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
      if (!config('app.enable_documents'))
        return false;
    }

    public function view(User $user, Document $document)
    {
      return $user->isTeacher()
        || $user
        ->group
        ->documents()
        ->where('id', $document->id)->count()
        != 0;
    }

  public function accept(User $user)
  {
    return $user->isTeacher();
  }

  public function edit(User $user, Document $document)
  {
    return
      $user->group != null
      && $user
        ->group
        ->documents()
        ->where('id', $document->id)->count() != 0
      && $user
        ->group
        ->documentIsOpened($document);
  }
}
