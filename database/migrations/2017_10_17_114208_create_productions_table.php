<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('situation_id')->nullable()->index('situation_id');
			$table->text('label', 65535)->nullable();
			$table->text('address', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('productions');
	}

}
