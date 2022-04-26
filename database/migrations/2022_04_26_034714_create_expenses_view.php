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
        DB::statement('DROP VIEW IF EXISTS expenses_view;');

        DB::statement(
            'CREATE VIEW expenses_view
            AS
            SELECT
                pengeluaran.id AS id,
                karyawan.nama_lengkap AS karyawan,
                pengeluaran.tanggal AS tanggal,
                IFNULL(
                    SUM(detail_pengeluaran.kuantitas),
                    0
                ) AS total_barang,
                IFNULL(
                    SUM(
                        detail_pengeluaran.harga * detail_pengeluaran.kuantitas
                    ),
                    0
                ) AS total_harga
                FROM
                    pengeluaran
                INNER JOIN karyawan ON pengeluaran.id_karyawan = karyawan.id
                LEFT JOIN detail_pengeluaran ON pengeluaran.id = detail_pengeluaran.id_pengeluaran
                GROUP BY
                    pengeluaran.id;
            '
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW [IF EXISTS] expenses_view;');
    }
};
