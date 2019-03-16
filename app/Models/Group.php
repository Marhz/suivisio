<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Datatables;
use Carbon;

class Group extends Model
{
    protected $fillable = [
    	'name', 'year', 'course_id', 'deadline', 'mac_address_deadline', 'poll_deadline'
    ];

    public function getTeacherListAttribute()
    {
        return $this->teachers->pluck('id')->all();
    }

    public function getDocumentListAttribute()
    {
      return $this->documents->pluck('id')->all();
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

    public function documents()
    {
      return $this->belongsToMany(Document::class);
    }

    public function isOpened()
    {
      return Carbon::now()->lessThan(new Carbon($this->deadline));
    }

    public function macAddressOpened()
    {
      return Carbon::now()->lessThan(new Carbon($this->mac_address_deadline));
    }

    public function pollOpened()
    {
      return Carbon::now()->lessThan(new Carbon($this->poll_deadline));
    }

    public function getUsers()
    {
      $users = collect($this->users);
      foreach ($this->teachers as $teacher)
          $users->push($teacher);
      return $users;
    }

    public function getUsersAndMacAddresses()
    {
      $users = $this->getUsers();
      $macAddresses = collect();
      foreach ($users as $user)
      {
        foreach ($user->macAddresses as $macAddress)
          $macAddresses->push($macAddress);
      }
      return $macAddresses;
    }

    public function setDeadlineAttribute($deadline)
    {
      if ($deadline != null)
        $this->attributes['deadline'] = $deadline;
    }

    public function setMacAddressDeadlineAttribute($deadline)
    {
      if ($deadline != null)
        $this->attributes['mac_address_deadline'] = $deadline;
    }

    public function setPollDeadlineAttribute($deadline)
    {
      if ($deadline != null)
        $this->attributes['poll_deadline'] = $deadline;
    }
}
