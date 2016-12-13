<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainActivity extends Model
{
	public $timestamps = false;
	protected $guarded = [];

	public function getActivityListAttribute()
    {
    	return $this->activities->pluck('id')->all();
    }

    public function activities()
    {
    	return $this->hasMany(Activity::class);
    }
}
