<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMacAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mac_addresses', function (Blueprint $table) {
        $table->integer('id', true);
        $table->integer('user_id');
        $table->string('address', 17);
  			$table->timestamps();
      });
      Schema::table('mac_addresses', function(Blueprint $table)
  		{
  			$table->foreign('user_id', 'mac_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
  		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('mac_addresses', function(Blueprint $table)
  		{
  			$table->dropForeign('mac_ibfk_1');
  		});
      Schema::dropIfExists('mac_addresses');
    }
}
