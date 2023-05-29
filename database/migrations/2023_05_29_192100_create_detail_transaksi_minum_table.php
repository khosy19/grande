<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiMinumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi_minum', function (Blueprint $table) {
            $table->increments('id_detail_transaksi_minuman')->unsigned();
            $table->integer('id_transaksi_minuman')->unsigned()->index();
            $table->integer('id_items_minuman')->unsigned()->index();
            $table->integer('jumlah_minuman');
            $table->timestamps();
        });

        Schema::table('detail_transaksi_minum', function ($table) {
            $table->foreign('id_transaksi_minuman')->references('id_transaksi')->on('transaksi')->onDelete('cascade');
        });

        Schema::table('detail_transaksi_minum', function ($table) {
            $table->foreign('id_items_minuman')->references('id_items')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksi_minum');
    }
}
