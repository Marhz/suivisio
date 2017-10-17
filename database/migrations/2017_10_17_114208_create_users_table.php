<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('group_id')->nullable()->index('group_id');
			$table->string('first_name', 50)->nullable();
			$table->string('last_name', 50)->nullable();
			$table->string('email', 150)->nullable()->unique('unique_index');
			$table->string('password', 70)->nullable();
			$table->boolean('level')->nullable()->default(2);
			$table->string('remember_token', 60)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
