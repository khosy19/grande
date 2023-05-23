<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->increments('id_detail_transaksi')->unsigned();
            $table->integer('id_transaksi')->unsigned()->index();
            $table->integer('id_items')->unsigned()->index();
            $table->integer('jumlah');
            // $table->timestamp('waktu_pesan')->nullable();
            // $table->timestamp('waktu_tunggu')->nullable();
            // $table->timestamp('waktu_selesai')->nullable();
            $table->timestamps();
        });

        Schema::table('detail_transaksi', function ($table) {
            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
        });

        Schema::table('detail_transaksi', function ($table) {
            $table->foreign('id_items')->references('id_items')->on('items')->onDelete('cascade');
        });
        // Schema::table('station', function ($table) {
        //     $table->foreign('id_station')->references('id_station')->on('station')->onDelete('cascade');
        // });
        // Schema::table('detail_transaksi', function ($table) {
        //     $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('detail_transaksi');
        Schema::enableForeignKeyConstraints();
    }
}
