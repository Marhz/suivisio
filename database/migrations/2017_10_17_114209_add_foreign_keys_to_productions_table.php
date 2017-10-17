<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProductionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('productions', function(Blueprint $table)
		{
			$table->foreign('situation_id', 'productions_ibfk_1')->references('id')->on('situations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('productions', function(Blueprint $table)
		{
			$table->dropForeign('productions_ibfk_1');
		});
	}

}
