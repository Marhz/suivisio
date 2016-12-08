<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Situation extends Model
{
    use SoftDeletes;

	protected $fillable =['name','description','begin_at','end_at','source_id'];

    protected $dates = ['begin_at','end_at','deleted_at'];


    public function getActivityListAttribute()
    {
    	return $this->activities->pluck('id')->all();
    }
    public function getEndAtAttribute()
    {
    	return \Carbon::createFromFormat('Y-m-d',$this->attributes['end_at'])->format('d/m/Y');
    }
    public function getbeginAtAttribute()
    {
    	return \Carbon::createFromFormat('Y-m-d',$this->attributes['begin_at'])->format('d/m/Y');
    }

    public function scopeGetUserSituations($query)
    {
    	return $query->where('user_id', '=', \Auth::user()->id)->with('source');
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function source()
    {
    	return $this->belongsTo(Source::class);
    }
    public function activities()
    {
    	return $this->belongsToMany(Activity::class)->withPivot('rephrasing');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
