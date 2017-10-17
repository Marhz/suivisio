<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDomainsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('domains', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('category_id')->nullable()->index('category_id');
			$table->string('nomenclature', 10)->nullable();
			$table->string('label')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('domains');
	}

}
