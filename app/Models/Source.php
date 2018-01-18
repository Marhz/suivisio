<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public function situations()
    {
    	return $this->hasMany(Situation::class);
    }
}
