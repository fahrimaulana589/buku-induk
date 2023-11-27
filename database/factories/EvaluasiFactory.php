<?php

namespace Database\Factories;

use App\Models\Evaluasi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EvaluasiFactory extends Factory
{
    protected $model = Evaluasi::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type' => 'utama',
            'evaluasi_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
