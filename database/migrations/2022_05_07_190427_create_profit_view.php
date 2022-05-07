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
        DB::statement('DROP VIEW IF EXISTS profit_view;');
        DB::statement(
            "CREATE VIEW profit_view
            AS
            SELECT
                DATE(
                    CONCAT(
                        incomes_by_month_view.tanggal,
                        '-01'
                    )
                ) AS tanggal,
                incomes_by_month_view.tanggal AS group_date,
                incomes_by_month_view.total_pendapatan AS pendapatan,
                IFNULL(
                    (
                    SELECT
                        expenses_by_month_view.total_pengeluaran
                    FROM
                        expenses_by_month_view
                    WHERE
                        expenses_by_month_view.tanggal = group_date
                ),
                0
                ) AS pengeluaran,
                (
                SELECT (pendapatan - pengeluaran)
            ) AS keuntungan
            FROM
                incomes_by_month_view;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS profit_view;');
    }
};
