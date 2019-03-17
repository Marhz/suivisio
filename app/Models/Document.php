<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['name'];

    public function groups()
    {
      return $this->belongsToMany(Group::class);
    }

    public function users()
    {
      return $this->belongsToMany(User::class)
        ->withPivot(['file_name', 'validated', 'comment']);
    }

    public function validatedStatus($user)
    {
      $users = $this->users()->where('id', $user->id)->first();
      if ($users == null)
        return 'warning';
      if (isset($users->pivot->validated))
        return ($users->pivot->validated) ? 'check' : 'times';
      else
        return 'clock-o';
    }
}
