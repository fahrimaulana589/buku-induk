<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'photo' => 'def.jpg',
            'birth_place' => $this->faker->word(),
            'birth_date' => Carbon::now(),
            'nuptk' => $this->faker->randomNumber(),
            'nip' => $this->faker->randomNumber(),
            'position' => 'guru olahraga',
            'level' => 'pns',
            'gender' => 'perempuan',
            'religion' => 'islam',
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'education' => 's1',
            'status' => 'nikah',
            'work_start_date' => Carbon::now(),
        ];
    }
}
