<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Year extends Model
{
    protected $fillable = ['name', 'short_name'];

    public function groups()
    {
      return $this->HasMany(Group::class);
    }

    public static function current()
    {
      $now = Carbon::now();
      if ($now->month > 7)
        $year = $now->year + 1;
      else
        $year = $now->year;
      $years = Year::where('name', ($year-1).'/'.$year);
      if ($years->count() > 0)
        $year = $years->first();
      else
        $year = Year::create(['name' => ($year-1).'/'.$year, 'short_name' => (substr($year, 2)-1).'/'.substr($year, 2)]);
      return $year;
    }
}
