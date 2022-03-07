<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    /**
     * Defines the model's default state
     *
     * @return array
     */
    public function definition() : array
    {
        $name = explode(' ', $this->faker->name());

        return [
            'first_name'        => $name[0],
            'last_name'         => $name[1],
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicates that the model's email address should be unverified
     *
     * @return Factory
     */
    public function unverified() : Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

}
