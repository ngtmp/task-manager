<?php

namespace Database\Factories;

use App\Support\Enum\Task\TaskStatus;
use App\Support\Enum\User\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
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
            'title' => fake()->text(rand(10, 30)),
            'description' => fake()->text(400),
            'status' => TaskStatus::forFactory(),
        ];
    }
}
