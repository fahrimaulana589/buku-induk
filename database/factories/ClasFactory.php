<?php

namespace Database\Factories;

use App\Models\Clas;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClasFactory extends Factory
{
    protected $model = Clas::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'teacher_id' => 1
        ];
    }
}
