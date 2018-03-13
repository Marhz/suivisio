<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $timetamps = false;

	public function getCategories()
	{
		return Category::with('activities')->where('course_id', $this->id)->orWhere('course_id',null)->orderBy('nomenclature', 'asc')->get();
	}
	
	public function categories()
	{
		return $this->hasMany(\App\Category::class);
	}
}
