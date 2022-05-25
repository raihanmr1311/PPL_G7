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
        $this->call(IndoRegionProvinceSeeder::class);
        $this->call(IndoRegionRegencySeeder::class);
        $this->call(IndoRegionDistrictSeeder::class);
        \App\Models\Employe::factory(20)->create();
        \App\Models\Item::factory(20)->create();
        Employe::create(
            [
                'nama_lengkap' => 'Maulana Malik',
                'nama_pengguna' => 'admin',
                'district_id' => 3511050,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'alamat' => 'Jalan Bondowoso',
                'nomor' => '20E',
                'no_hp' => '02187491287421',
                'role' => 'OWNER'
            ]
        );

        Employe::create(
            [
                'nama_lengkap' => 'Agus',
                'nama_pengguna' => 'karyawan',
                'district_id' => 3511050,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'alamat' => 'Jalan Bondowoso',
                'nomor' => '20E',
                'no_hp' => '02187491284422',
                'role' => 'OWNER'
            ]
        );

        Wallet::create(
            ['balance' => 0]
        );
    }
}
