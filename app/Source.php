<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public function situations()
    {
    	return $this->hasMany(Situation::class);
    }
}
