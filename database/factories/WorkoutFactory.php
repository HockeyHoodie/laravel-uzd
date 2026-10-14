<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Workout>
 */
class WorkoutFactory extends Factory
{
    protected $model = Workout::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->randomElement([
                'Kāju treniņš',
                'Roku spēks',
                'Plecu un muguras diena',
                'Visa ķermeņa treniņš',
                'Kardio un vēdera preses',
            ]),
            'performed_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
