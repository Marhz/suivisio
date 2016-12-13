<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Activity extends Model
{
    use SoftDeletes;
    
    public $timestamps = false;
    protected $guarded = [];

    public function fullName()
	{
		return $this->nomenclature.' - '.$this->label;
	}
    public function situations()
    {
    	return $this->belongsToMany(Situation::class);
    }
    public function category()
    {
    	return $this->belongsToMany(Category::class);
    }
   
}
