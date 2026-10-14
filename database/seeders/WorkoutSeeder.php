<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Seeder;

class WorkoutSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->each(function (User $user): void {
            Workout::factory()
                ->count(fake()->numberBetween(3, 5))
                ->for($user)
                ->create()
                ->each(function (Workout $workout): void {
                    Exercise::factory()
                        ->count(fake()->numberBetween(3, 6))
                        ->for($workout)
                        ->create();
                });
        });
    }
}
