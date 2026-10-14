<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Exercise>
 */
class ExerciseFactory extends Factory
{
    protected $model = Exercise::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'workout_id' => Workout::factory(),
            'name' => fake()->randomElement([
                'Pietupieni',
                'Plecis presē',
                'Deadlift',
                'Pavedieni',
                'Stiepšanās',
                'Kāju spiešana',
            ]),
            'sets' => fake()->numberBetween(3, 5),
            'reps' => fake()->numberBetween(6, 15),
            'weight_kg' => fake()->optional(0.7)->randomFloat(1, 20, 120),
        ];
    }
}
