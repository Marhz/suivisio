<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = false;


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
