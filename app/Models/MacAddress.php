<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MacAddress extends Model
{
  protected $fillable = [
      'address'
  ];

  public function fullName()
  {
    return $this->address;
  }
}
