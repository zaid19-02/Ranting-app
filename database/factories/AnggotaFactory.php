<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnggotaFactory extends Factory
{
    protected $model = Anggota::class;

    public function definition()
    {
        return [
            'kode_wilayah' => 'KW-' . $this->faker->unique()->numberBetween(100, 999),
            'nama_anggota' => $this->faker->name(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'alamat' => $this->faker->address(),
            'kelurahan' => $this->faker->streetName(),
            'kecamatan' => $this->faker->streetName(),
            'kabupaten_kota' => $this->faker->city(),
            'provinsi' => $this->faker->state(),
            'ranting' => 'Ranting ' . $this->faker->word(),
            'status' => $this->faker->randomElement(['Aktif', 'Tidak Aktif']),
            'no_telpon' => $this->faker->phoneNumber(),
        ];
    }
}
