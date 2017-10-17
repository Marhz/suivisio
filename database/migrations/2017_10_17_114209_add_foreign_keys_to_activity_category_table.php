<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActivityCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activity_category', function(Blueprint $table)
		{
			$table->foreign('activity_id', 'activity_category_ibfk_1')->references('id')->on('activities')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('category_id', 'activity_category_ibfk_2')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activity_category', function(Blueprint $table)
		{
			$table->dropForeign('activity_category_ibfk_1');
			$table->dropForeign('activity_category_ibfk_2');
		});
	}

}
