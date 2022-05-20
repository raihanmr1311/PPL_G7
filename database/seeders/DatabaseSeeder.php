<?php

namespace Database\Seeders;

use App\Models\Employe;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\District::factory(20)->create();
        \App\Models\Employe::factory(20)->create();
        \App\Models\Item::factory(20)->create();
        Employe::create(
            [
                'nama_lengkap' => 'Maulana Malik',
                'nama_pengguna' => 'admin',
                'id_kecamatan' => 2,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'alamat' => 'Jalan Bondowoso',
                'nomor' => '20E',
                'no_hp' => '02187491287421'
            ]
        );

        Employe::create(
            [
                'nama_lengkap' => 'Agus',
                'nama_pengguna' => 'karyawan',
                'id_kecamatan' => 2,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'alamat' => 'Jalan Bondowoso',
                'nomor' => '20E',
                'no_hp' => '02187491284422'
            ]
        );

        Wallet::create(
            ['balance' => 0]
        );
    }
}
