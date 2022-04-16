<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemasukan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemasukan');
            $table->unsignedBigInteger('id_barang');
            $table->unsignedInteger('kuantitas');
            $table->unsignedBigInteger('harga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pemasukan');
    }
};