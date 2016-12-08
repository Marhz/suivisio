<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function activities()
    {
    	return $this->hasMany(Activity::class);
    }

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
