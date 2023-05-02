<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama_barang');
            $table->integer('stok');
            $table->integer('jumlah');
            $table->decimal('harga',15, 2);
            $table->timestamps();

            $table->foreign('barang_id')->references('id')->on('barang');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
