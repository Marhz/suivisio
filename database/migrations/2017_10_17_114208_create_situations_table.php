<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSituationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('situations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable();
			$table->integer('source_id')->nullable();
			$table->string('name')->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('context')->nullable();
			$table->date('begin_at')->nullable();
			$table->date('end_at')->nullable();
			$table->string('environement')->nullable();
			$table->string('tools')->nullable();
			$table->boolean('validate')->nullable()->default(0);
			$table->timestamps();
			$table->softDeletes();
			$table->boolean('viewed')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('situations');
	}

}
