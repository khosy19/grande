<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian', function (Blueprint $table) {
            $table->increments('id_antrian')->unsigned();
            $table->integer('id_detail_transaksi')->unsigned()->index();
            $table->integer('id_station')->unsigned()->index();
            // $table->integer('id_transaksi')->unsigned()->index();
            $table->integer('id_users')->unsigned()->index();
            $table->text('waktu_tiba')->nullable();
            $table->text('start_time')->nullable();
            $table->text('burst_time')->nullable();
            $table->text('finish_time')->nullable();
            $table->text('tat')->nullable();
            $table->text('waiting_time')->nullable();
            // $table->timestamp('waktu_keluar')->nullable();
            $table->timestamps();
        });

        // Schema::table('antrian', function ($table) {
        //     $table->foreign('id_detail_transaksi')->references('id_detail_transaksi')->on('detail_transaksi')->onDelete('cascade');
        // });

        // Schema::table('antrian', function ($table) {
        //     $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        // });
        // Schema::table('antrian', function ($table) {
        //     $table->foreign('id_station')->references('id_station')->on('station')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('antrian');
        Schema::enableForeignKeyConstraints();
    }
}
