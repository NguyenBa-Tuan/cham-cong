<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('11111111'),
            'remember_token' => Str::random(10),
            'address' => $this->faker->streetAddress(),
            'phone' => $this->faker->phoneNumber(),
            'dayOfBirth' => $this->faker->date('Y-m-d'),
            'dayOfJoin' => $this->faker->date('Y-m-d'),
            'role' => '1',
            'level' => $this->faker->numberBetween(1, 5),
        ];
    }
}
