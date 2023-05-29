<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrianMinumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian_minum', function (Blueprint $table) {
            $table->increments('id_antrian_minum')->unsigned();
            $table->integer('id_detail_transaksi_minum')->unsigned()->index();
            $table->integer('id_station_minum')->unsigned()->index();
            // $table->integer('id_transaksi')->unsigned()->index();
            $table->integer('id_users_minum')->unsigned()->index();
            $table->text('waktu_tiba_minum')->nullable();
            $table->text('start_time_minum')->nullable();
            $table->text('burst_time_minum')->nullable();
            $table->text('finish_time_minum')->nullable();
            $table->text('tat_minum')->nullable();
            $table->text('waiting_time_minum')->nullable();
            // $table->timestamp('waktu_keluar')->nullable();
            $table->timestamps();
        });

        // Schema::table('antrian_minum', function ($table) {
        //     $table->foreign('id_detail_transaksi_minum')->references('id_detail_transaksi_minuman')->on('detail_transaksi_minum')->onDelete('cascade');
        // });

        // Schema::table('antrian_minum', function ($table) {
        //     $table->foreign('id_users_minum')->references('id')->on('users')->onDelete('cascade');
        // });
        // Schema::table('antrian_minum', function ($table) {
        //     $table->foreign('id_station_minum')->references('id_station')->on('station')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antrian_minum');
    }
}
