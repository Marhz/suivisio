<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('document_group', function (Blueprint $table) {
        $table->integer('group_id');
        $table->integer('document_id');
        $table->timestamps();
        $table->primary(['group_id', 'document_id']);
      });
      Schema::table('document_group', function(Blueprint $table)
      {
        $table->foreign('group_id')->references('id')->on('groups');
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
      Schema::dropIfExists('document_group');
    }
}
