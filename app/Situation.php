<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
	protected $fillable =['name','description','begin_at','end_at','source_id'];

    protected $dates = ['begin_at','end_at','deleted_at'];
    
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
    	return $this->belongsToMany(Activity::class);
    }
}
