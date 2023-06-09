<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi')->unsigned()->index();
            $table->string('invoice');
            $table->integer('id_users')->unsigned()->index();
            // $table->integer('id_station')->unsigned()->index();
            $table->integer('total');
            $table->integer('rating')->default(0);
            $table->integer('metode'); //1 = cash, 2 = debit card 3, bill
            $table->integer('status')->default(2); //1 = DONE, 0 = UNDONE, 2=unpayment
            $table->integer('kode_referensi')->nullable();
            // $table->integer('waktu_pesan')->nullable();
            $table->timestamps();
        });

        Schema::table('transaksi', function ($table) {
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
        // Schema::table('station', function ($table) {
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
        Schema::dropIfExists('transaksi');
    }
}
