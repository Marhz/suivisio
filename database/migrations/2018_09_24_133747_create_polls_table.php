<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('polls', function (Blueprint $table) {
        $table->integer('id', true);
        $table->integer('course_id');
        $table->string('name');
        $table->timestamps();
        $table->softDeletes();        
      });
      Schema::table('polls', function(Blueprint $table)
  		{
  			$table->foreign('course_id', 'poll_ibfk_1')->references('id')->on('courses')->onUpdate('RESTRICT')->onDelete('RESTRICT');
  		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('polls', function(Blueprint $table)
  		{
  			$table->dropForeign('poll_ibfk_1');
  		});
      Schema::dropIfExists('polls');
    }
}
