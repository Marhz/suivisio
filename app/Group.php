<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Datatables;

class Group extends Model
{
    protected $fillable = [
    	'name', 'year', 'course_id'
    ];


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
}
