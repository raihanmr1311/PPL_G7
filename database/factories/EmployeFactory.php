<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_lengkap' => $this->faker->name(),
            'nama_pengguna' => $this->faker->userName(),
            'id_kecamatan' => $this->faker->numberBetween(1, 9),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'alamat' => $this->faker->address(),
            'nomor' => $this->faker->streetAddress(),
            'no_hp' => $this->faker->phoneNumber()
        ];
    }
}
