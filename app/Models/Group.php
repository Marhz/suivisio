<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Datatables;
use Carbon;

class Group extends Model
{
    protected $fillable = [
    	'name', 'year', 'course_id', 'deadline'
    ];

    public function getTeacherListAttribute()
    {
        return $this->teachers->pluck('id')->all();
    }
    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function teachers()
    {
    	return $this->belongsToMany(User::class);
    }

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }

    public function isOpened()
    {
      return Carbon::now()->lessThan(new Carbon($this->deadline));
    }
}
