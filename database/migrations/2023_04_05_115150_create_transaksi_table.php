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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('pelanggan_id');
            $table->date('tanggal');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            
            $table->foreign('barang_id')->references('id')->on('barang');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan');
        });
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
