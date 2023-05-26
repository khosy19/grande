<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id_items')->unsigned()->index();
            $table->string('nama_makanan');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->string('foto');
            $table->smallInteger('tipe'); //1 = makanan, 2 = minuman
            $table->smallInteger('aktif'); //1 = makanan, 2 = minuman
            $table->integer('waktu_menu')->nullable();
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
        Schema::dropIfExists('items');
    }
}
