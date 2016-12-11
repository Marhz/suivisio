<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'group_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    //
    //helpers
    //

    public function isAdmin()
    {
        return $this->level == 0;
    }
    public function isTeacher()
    {
        return $this->level < 2;
    }
    public function isStudent()
    {
        return $this->level == 2;
    }
    public function fullName()
    {
        return $this->first_name.' '.$this->last_name;
    }
    public function getActivitiesId()
    {
        $activities = $this->situations()->with('activities')->get();
        return $this->extractActivitiesId($activities);
    }
    protected function newCommmentsCount()
    {
        return Comment::where('user_id', '=', $this->id)->where('viewed', '=', 0)->count();
    }
    protected function extractActivitiesId($situations)
    {
        $activities = [];
        foreach($situations as $situation)
            array_push($activities, ...$situation->getActivitiesId());
        return array_unique($activities);
    }

    //
    // scopes
    //

    public function scopeStudent($query)
    {
        return $query->where('level', '=', 2); // Dans la BDD, level 0 = admin, 1 = prof, 2 = étudiant
    }

    //
    // relations
    //
    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function teacherOf()
    {
        return $this->belongsToMany(Group::class);
    }
    public function situations()
    {
        return $this->hasMany(Situation::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
