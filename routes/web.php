<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('workouts', WorkoutController::class);

    Route::post('workouts/{workout}/exercises', [ExerciseController::class, 'store'])
        ->name('workouts.exercises.store');
    Route::patch('workouts/{workout}/exercises/{exercise}', [ExerciseController::class, 'update'])
        ->name('workouts.exercises.update');
    Route::delete('workouts/{workout}/exercises/{exercise}', [ExerciseController::class, 'destroy'])
        ->name('workouts.exercises.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
