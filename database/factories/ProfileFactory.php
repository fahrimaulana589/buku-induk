<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'logo' => $this->faker->word(),
            'email' => 'email@email.com',
            'host' => Env('MAIL_HOST'),
            'port' => Env('MAIL_PORT'),
            'username'=> Env('MAIL_USERNAME'),
            'password' => Env('MAIL_PASSWORD'),
        ];
    }
}
