<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AccountCreatedNotification;

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
        'first_name', 'last_name', 'numeroCandidat', 'email', 'password', 'group_id', 'portefeuille'
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
    public function getGroupListAttribute()
    {
        return $this->teacherOf->pluck('id')->all();
    }

    public function isAdmin()
    {
        return $this->level == 0;
    }

    public function setAdmin()
    {
      $this->level = 0;
    }

    public function isTeacher()
    {
        return $this->level < 2;
    }

    public function setTeacher()
    {
      $this->level = 1;
    }

    public function isStudent()
    {
        return $this->level == 2;
    }

    public function setStudent()
    {
        $this->level = 2;
    }

    public function fullName()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function isOpened()
    {
      return $this->group != null && $this->group->isOpened();
    }

    public function isLocked()
    {
      return !$this->isOpened();
    }

    public function warning()
    {
      return $this->numeroCandidat == null
        || $this->can('enablePorteFolioCollect', $this) && $this->portefeuille == null;
    }

    public function getDocumentStatus($document)
    {
      $doc = $this->documents()->where('document_id', $document->id)->first();
      $pivot = ($doc != null) ? $doc->pivot : null;
      return view('documents.partials.link')
        ->with(['document' => $document, 'pivot' => $pivot])
        ->render();
    }

    public function macAddressOpened()
    {
      return $this->isTeacher() || $this->group->macAddressOpened();
    }

    public function pollOpened()
    {
      return $this->group == null || $this->group->pollOpened();
    }

    public function getPoll()
    {
        return $this->polls->intersect($this->group->course->polls)->first();
    }

    public function getActivitiesId()
    {
        $situations = $this->situations()->with('activities')->get();
        return $this->extractActivitiesId($situations);
    }

    public function getActivitiesIdWhere($column,$operator,$search)
    {
        $situations = $this->situations()->with('activities')->where($column,$operator,$search)->get();
        return $this->extractActivitiesId($situations);
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

    public function owns(Situation $situation)
    {
        return $situation->user_id == $this->id;
    }

    public function hasSituations()
    {
      return $this->situations()
        ->where('show', 1)
        ->count() > 0;
    }

    //
    // scopes
    //

    public function scopeStudent($query)
    {
        return $query->where('level', '=', 2); // Dans la BDD, level 0 = admin, 1 = prof, 2 = étudiant
    }

    public function scopeTeachers($query)
    {
        return $query->where('level', '<', 2);
    }

    //
    // relations
    //

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function documents()
    {
      return $this->belongsToMany(Document::class)
          ->withPivot(['file_name', 'validated', 'comment']);
    }

    public function teacherOf()
    {
        return $this->belongsToMany(Group::class);
    }

    public function teacherOfThisYear()
    {
        return $this->teacherOf()->where('year_id', \App\Models\Year::current()->id)->get();
    }

    public function situations()
    {
        return $this->hasMany(Situation::class);
    }

    public function macAddresses()
    {
        return $this->hasMany(MacAddress::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function polls()
    {
        return $this->belongsToMany(Poll::class);
    }
}
