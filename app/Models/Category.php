<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function getActivityListAttribute()
    {
    	return $this->activities->pluck('id')->all();
    }
    public function activities()
    {
    	return $this->belongsToMany(Activity::class);
    }

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
