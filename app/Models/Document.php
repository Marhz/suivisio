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
        ->withPivot('file_name');
    }
}
