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
        Schema::create('detail_pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('pengeluaran', 60);
            $table->unsignedInteger('kuantitas')->default(0);
            $table->unsignedBigInteger('harga')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengeluaran');
    }
};
