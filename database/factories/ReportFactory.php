<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        return [
            'student_id' => '1',
            'school_year_id' => '1',
            'class_id' => '1',
            'semester' => 'ganjil',
        ];
    }
}
