<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function store(StoreExerciseRequest $request, Workout $workout): RedirectResponse
    {
        $this->authorize('update', $workout);

        $workout->exercises()->create($request->validated());

        return redirect()
            ->route('workouts.show', $workout)
            ->with('success', 'Vingrojums pievienots.');
    }

    public function update(UpdateExerciseRequest $request, Workout $workout, Exercise $exercise): RedirectResponse
    {
        $this->authorize('update', $workout);
        $this->ensureExerciseBelongsToWorkout($workout, $exercise);

        $exercise->update($request->validated());

        return redirect()
            ->route('workouts.show', $workout)
            ->with('success', 'Vingrojums atjaunināts.');
    }

    public function destroy(Request $request, Workout $workout, Exercise $exercise): JsonResponse|RedirectResponse
    {
        $this->authorize('update', $workout);
        $this->ensureExerciseBelongsToWorkout($workout, $exercise);

        $exercise->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Vingrojums dzēsts.']);
        }

        return redirect()
            ->route('workouts.show', $workout)
            ->with('success', 'Vingrojums dzēsts.');
    }

    private function ensureExerciseBelongsToWorkout(Workout $workout, Exercise $exercise): void
    {
        if ($exercise->workout_id !== $workout->id) {
            abort(404);
        }
    }
}
