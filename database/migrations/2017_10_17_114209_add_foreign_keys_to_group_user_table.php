<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGroupUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('group_user', function(Blueprint $table)
		{
			$table->foreign('user_id', 'group_user_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('group_id', 'group_user_ibfk_2')->references('id')->on('groups')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('group_user', function(Blueprint $table)
		{
			$table->dropForeign('group_user_ibfk_1');
			$table->dropForeign('group_user_ibfk_2');
		});
	}

}
