<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class TableYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('years', function (Blueprint $table) {
        $table->integer('id', true);
        $table->string('name');
        $table->string('short_name');
        $table->timestamps();
      });
      Schema::table('groups', function(Blueprint $table)
      {
        $table->integer('year_id')->nullable();
      });
      $years = DB::select("select distinct year from groups");
      foreach ($years as $year)
      {
        $str = $year->year;
        DB::table("years")->insert(
            [
                'name' => ($str-1).'/'.$str,
                'short_name' => (substr($str, 2)-1).'/'.substr($str, 2)
            ]);
      }
      DB::update("update groups set year_id = (select id from years where substr(name, 6) = groups.year)");
      Schema::table('groups', function (Blueprint $table) {
        $table->dropColumn('year');
      });
      Schema::table('groups', function(Blueprint $table)
      {
        $table->foreign('year_id')->references('id')->on('years');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('groups', function (Blueprint $table) {
        $table->string('year');
      });
      DB::update("update groups set year = (select substr(name, 6) from years where year_id = years.id)");
      Schema::table('groups', function(Blueprint $table)
      {
        $table->dropForeign('groups_year_id_foreign');
      });
      Schema::table('groups', function (Blueprint $table) {
        $table->dropColumn('year_id');
      });
      Schema::dropIfExists('years');
    }
}
