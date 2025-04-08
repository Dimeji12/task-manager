<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Generates a random name
            'email' => fake()->unique()->safeEmail(), // Generates a unique email
            'email_verified_at' => now(), // Sets email_verified_at to the current time
            'password' => Hash::make('password'), // Default password is 'password'
            'remember_token' => Str::random(10), // Generates a random remember token
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null, // Sets email_verified_at to null for unverified users
        ]);
    }
}