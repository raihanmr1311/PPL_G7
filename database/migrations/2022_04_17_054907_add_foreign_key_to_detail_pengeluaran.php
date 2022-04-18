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
        Schema::table('detail_pengeluaran', function (Blueprint $table) {
            $table->after('id', function ($table) {
                $table->foreignId('id_pengeluaran')->constrained('pengeluaran')->cascadeOnUpdate()->cascadeOnDelete();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_pengeluaran', function (Blueprint $table) {
            //
        });
    }
};
