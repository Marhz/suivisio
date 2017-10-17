<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitySituationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_situation', function(Blueprint $table)
		{
			$table->integer('activity_id');
			$table->integer('situation_id')->index('situation_id');
			$table->text('rephrasing', 65535)->nullable();
			$table->primary(['activity_id','situation_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity_situation');
	}

}
