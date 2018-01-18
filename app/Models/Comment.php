<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['situation_id','user_id','comment'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function situation()
    {
    	return $this->belongsTo(Situation::class);
    }
}
