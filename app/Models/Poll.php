<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Carbon;

class Poll extends Model
{
    use SoftDeletes;

	  protected $fillable =['name', 'course_id'];

    public function group()
    {
    	return $this->belongsTo(Group::class);
    }

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }
}
