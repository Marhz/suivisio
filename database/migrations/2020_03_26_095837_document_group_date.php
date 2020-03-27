<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DocumentGroupDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('document_group', function (Blueprint $table) {
        $table->date('deadline')->nullable();
      });
      DB::update("update document_group set deadline = (select deadline from groups where group_id = id)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('document_group', function (Blueprint $table) {
        $table->dropColumn('deadline');
      });
    }
}
