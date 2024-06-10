<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblCbhd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cbhd', function (Blueprint $table) {
            $table->increments('id');
            $table->string('macbhd', 30);
            $table->string('tencanbo', 50);
            $table->string('donvi', 200);
            $table->string('phongban', 250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_cbhd');
    }
}
