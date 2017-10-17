<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivityCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_category', function(Blueprint $table)
		{
			$table->integer('activity_id')->default(0);
			$table->integer('category_id')->default(0)->index('category_id');
			$table->primary(['activity_id','category_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activity_category');
	}

}
