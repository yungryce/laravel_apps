<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected static $userCount = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {

        // Limit user count to 10
        $index = $this->sequence() ?? 0;
    
        return [
            'title' => fake()->sentence,
            'description' => fake()->paragraph(5, true),
            'status' => $this->faker->randomElement(['start', 'pending', 'in progress', 'done', 'close']),
        ];
    }
}
