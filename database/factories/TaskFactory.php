<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3), // Generates a 3-word sentence for the task name
            'description' => fake()->paragraph(), // Generates a random paragraph for the description
            'status' => fake()->randomElement(['in-progress', 'completed']), // Randomly assigns a status
            'user_id' => User::factory(), // Associates the task with a user (creates a new user if none exists)
        ];
    }
}