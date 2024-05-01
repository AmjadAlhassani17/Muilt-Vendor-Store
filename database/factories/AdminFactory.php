<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->userName,
            'password' => Hash::make('password'),   // Hash the password
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'super_admin' => $this->faker->boolean,
        ];
    }
}