<?php

namespace Database\Factories;

use App\Models\Father;
use Illuminate\Database\Eloquent\Factories\Factory;

class FatherFactory extends Factory
{
    protected $model = Father::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'birth_place' => fake()->city,
            'birth_date' => fake()->date,
            'religion' => "islam",
            'citizenship' => 'idonesia',
            'education' => 'S1',
            'work' => 'Guru',
            'monthly_income' => 10_000_000,
            'address' => fake()->address,
            'phone' => fake()->phoneNumber,
            'died_at' => fake()->date,
        ];
    }
}
