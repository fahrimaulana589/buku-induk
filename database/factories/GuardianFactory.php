<?php

namespace Database\Factories;

use App\Models\Guardian;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuardianFactory extends Factory
{
    protected $model = Guardian::class;

    public function definition(): array
    {
        return [
            'student_id' => 1,
            'type' => 'ayah',
            'name' => null,
            'birth_place' => null,
            'birth_date' => null,
            'religion' => null,
            'citizenship' => null,
            'status' => null,
            'address' => null,
            'phone' => null,
        ];
    }
}
