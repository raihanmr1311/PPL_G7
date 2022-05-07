<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement('DROP VIEW IF EXISTS incomes_by_month_view;');
        DB::statement(
            "CREATE VIEW incomes_by_month_view
            AS
            SELECT
                DATE_FORMAT(tanggal, '%Y-%m') AS tanggal,
                SUM(total_harga) AS total_pendapatan
            FROM
                incomes_view
            GROUP BY
                DATE_FORMAT(tanggal, '%Y-%m');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS incomes_by_month_view;');
    }
};
