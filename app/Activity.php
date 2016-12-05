<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = false;


    public function scopeFormatForSelect()
	{
		$this->nomenclature .= ' - '.$this->label;
	}
	public function test()
	{
		var_dump('yolo');
	}
    public function situations()
    {
    	return $this->belongsToMany(Situation::class);
    }
   
}
