<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Nim' => $this->faker->randomNumber(9),
            'Nama' => $this->faker->word(),
            'Kelas' => $this->faker->text(10),
            'Jurusan' => $this->faker->text(10),
            'No_Handphone' => $this->faker->phoneNumber(),
            'Email' => $this->faker->email(),
            'Tgl_lahir' => $this->faker->date(),
        ];
    }
}
