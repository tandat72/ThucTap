<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Quanlysinhvien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sinhvien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tensinhvien', 255);
            $table->string('sodienthoai', 15);
            $table->string('email', 200);
            $table->string('diachi', 250);
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
        Schema::dropIfExists('tbl_sinhvien');
    }
}
