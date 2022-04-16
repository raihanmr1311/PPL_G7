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
        Schema::table('detail_pemasukan', function (Blueprint $table) {
            $table->foreign('id_pemasukan')->references('id')->on('pemasukan')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_pemasukan', function (Blueprint $table) {
            //
        });
    }
};
