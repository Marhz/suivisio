<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('poll_user', function(Blueprint $table)
  		{
  			$table->integer('user_id')->default(0);
  			$table->integer('poll_id')->default(0)->index('poll_id');
  			$table->primary(['user_id','poll_id']);
  		});
      Schema::table('poll_user', function(Blueprint $table)
  		{
  			$table->foreign('user_id', 'poll_user_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
  			$table->foreign('poll_id', 'poll_user_ibfk_2')->references('id')->on('polls')->onUpdate('RESTRICT')->onDelete('RESTRICT');
  		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('poll_user', function(Blueprint $table)
  		{
  			$table->dropForeign('poll_user_ibfk_1');
  			$table->dropForeign('poll_user_ibfk_2');
  		});
      Schema::drop('poll_user');
    }
}
