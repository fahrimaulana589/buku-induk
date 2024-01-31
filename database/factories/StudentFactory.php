<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'mother_id' => 1,
            'father_id' => 1,
            'class_id' => 1,
            'nis' => fake()->randomDigit(),
            'name' => fake()->name,
            'photo' => 'def.jpg',
            'status' => 'active',
            'gender' => 'laki laki',
            'birth_place' => 'tegal',
            'birth_date' => fake()->date,
            'religion' => 'Islam',
            'citizenship' => 'Tegal',
            'fam_order' => 2,
            'fam_count' => 4,
            'fam_status' => 'anak',
            'language' => 'Indo',
            'address' => 'test',
            'phone' => fake()->phoneNumber,
            'live_with' => 'Ayah',
            'blood_type' => 'A',
            'height' => 12,
            'weight' => 12,
            'hobby' => 'makan',
        ];
    }
}
