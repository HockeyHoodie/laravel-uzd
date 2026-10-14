<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use App\Models\Workout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkoutController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $workouts = Workout::query()
            ->where('user_id', $request->user()->id)
            ->when($search !== '', fn ($query) => $query->where('title', 'like', '%'.$search.'%'))
            ->withCount('exercises')
            ->orderByDesc('performed_at')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('workouts.index', [
            'workouts' => $workouts,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('workouts.create');
    }

    public function store(StoreWorkoutRequest $request): RedirectResponse
    {
        $workout = $request->user()->workouts()->create($request->validated());

        return redirect()
            ->route('workouts.show', $workout)
            ->with('success', 'Treniņš izveidots.');
    }

    public function show(Request $request, Workout $workout): View
    {
        $this->authorize('view', $workout);

        $workout->load(['exercises' => fn ($query) => $query->orderBy('id')]);

        return view('workouts.show', [
            'workout' => $workout,
        ]);
    }

    public function edit(Request $request, Workout $workout): View
    {
        $this->authorize('update', $workout);

        return view('workouts.edit', [
            'workout' => $workout,
        ]);
    }

    public function update(UpdateWorkoutRequest $request, Workout $workout): RedirectResponse
    {
        $this->authorize('update', $workout);

        $workout->update($request->validated());

        return redirect()
            ->route('workouts.show', $workout)
            ->with('success', 'Treniņš atjaunināts.');
    }

    public function destroy(Request $request, Workout $workout): RedirectResponse
    {
        $this->authorize('delete', $workout);

        $workout->delete();

        return redirect()
            ->route('workouts.index')
            ->with('success', 'Treniņš dzēsts.');
    }
}
