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
            'email' => "xample@gmail.com",
            'host' => 'mail.com',
            'port' => '20',
            'username'=> 'username',
            'password' => 'password',
        ];
    }
}
