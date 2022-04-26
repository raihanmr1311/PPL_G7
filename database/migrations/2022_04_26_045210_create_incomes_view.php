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
        DB::statement('DROP VIEW IF EXISTS incomes_view;');
        DB::statement(
            'CREATE VIEW incomes_view
            AS
            SELECT
                pemasukan.id AS id,
                karyawan.nama_lengkap AS karyawan,
                pemasukan.tanggal AS tanggal,
                IFNULL(
                    SUM(detail_pemasukan.kuantitas),
                    0
                ) AS total_barang,
                IFNULL(
                    SUM(
                        detail_pemasukan.harga * detail_pemasukan.kuantitas
                    ),
                    0
                ) AS total_harga,
                pemasukan.created_at AS created_at,
                pemasukan.updated_at AS updated_at
                FROM
                    pemasukan
                INNER JOIN karyawan ON pemasukan.id_karyawan = karyawan.id
                LEFT JOIN detail_pemasukan ON pemasukan.id = detail_pemasukan.id_pemasukan
                GROUP BY
                    pemasukan.id;'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS incomes_view;');
    }
};
