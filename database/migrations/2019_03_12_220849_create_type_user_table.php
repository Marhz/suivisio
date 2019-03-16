<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('document_user', function (Blueprint $table) {
        $table->integer('user_id');
        $table->integer('document_id');
        $table->string('file_name');
        $table->timestamps();
        $table->primary(['user_id', 'document_id']);
      });
      Schema::table('document_user', function(Blueprint $table)
      {
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('document_id')->references('id')->on('documents');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('document_user');
    }
}
