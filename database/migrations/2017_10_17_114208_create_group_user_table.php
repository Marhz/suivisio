<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_user', function(Blueprint $table)
		{
			$table->integer('user_id')->default(0);
			$table->integer('group_id')->default(0)->index('group_id');
			$table->primary(['user_id','group_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('group_user');
	}

}
