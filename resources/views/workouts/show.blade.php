<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $workout->title }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">{{ $workout->performed_at->format('Y-m-d') }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('workouts.edit', $workout) }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Labot treniņu
                </a>
                <a href="{{ route('workouts.index') }}" class="inline-flex items-center rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    Atpakaļ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($workout->notes)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-sm font-medium text-gray-700">Piezīmes</h3>
                        <p class="mt-2 text-gray-600 whitespace-pre-line">{{ $workout->notes }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pievienot vingrojumu</h3>
                    <form method="post" action="{{ route('workouts.exercises.store', $workout) }}" class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                        @csrf
                        <div class="sm:col-span-2">
                            <x-input-label for="name" value="Nosaukums" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="sets" value="Pieejas" />
                            <x-text-input id="sets" name="sets" type="number" min="1" class="mt-1 block w-full" :value="old('sets', 3)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('sets')" />
                        </div>
                        <div>
                            <x-input-label for="reps" value="Atkārtojumi" />
                            <x-text-input id="reps" name="reps" type="number" min="1" class="mt-1 block w-full" :value="old('reps', 10)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('reps')" />
                        </div>
                        <div>
                            <x-input-label for="weight_kg" value="Svars (kg)" />
                            <x-text-input id="weight_kg" name="weight_kg" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('weight_kg')" />
                            <x-input-error class="mt-2" :messages="$errors->get('weight_kg')" />
                        </div>
                        <div class="sm:col-span-2 lg:col-span-5">
                            <x-primary-button>Pievienot</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Vingrojumi</h3>

                    @if ($workout->exercises->isEmpty())
                        <p class="text-gray-600">Šim treniņam vēl nav vingrojumu.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm" id="exercises-table">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Nosaukums</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Pieejas</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Atkārtojumi</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Svars (kg)</th>
                                        <th class="px-4 py-3 text-right font-medium text-gray-700">Darbības</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($workout->exercises as $exercise)
                                        <tr data-exercise-row="{{ $exercise->id }}">
                                            <td colspan="5" class="p-0">
                                                <form method="post" action="{{ route('workouts.exercises.update', [$workout, $exercise]) }}" class="grid grid-cols-1 gap-2 p-4 sm:grid-cols-5 sm:items-end">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="sm:col-span-1">
                                                        <x-input-label :for="'name-'.$exercise->id" value="Nosaukums" class="sr-only" />
                                                        <x-text-input :id="'name-'.$exercise->id" name="name" type="text" class="block w-full" :value="old('name', $exercise->name)" required />
                                                    </div>
                                                    <div>
                                                        <x-text-input name="sets" type="number" min="1" class="block w-full" :value="old('sets', $exercise->sets)" required />
                                                    </div>
                                                    <div>
                                                        <x-text-input name="reps" type="number" min="1" class="block w-full" :value="old('reps', $exercise->reps)" required />
                                                    </div>
                                                    <div>
                                                        <x-text-input name="weight_kg" type="number" step="0.01" min="0" class="block w-full" :value="old('weight_kg', $exercise->weight_kg)" />
                                                    </div>
                                                    <div class="flex justify-end gap-2 sm:col-span-1">
                                                        <x-secondary-button type="submit">Saglabāt</x-secondary-button>
                                                        <button
                                                            type="button"
                                                            class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 js-delete-exercise"
                                                            data-url="{{ route('workouts.exercises.destroy', [$workout, $exercise]) }}"
                                                        >
                                                            Dzēst
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('.js-delete-exercise').forEach((button) => {
                button.addEventListener('click', async () => {
                    if (! confirm('Dzēst vingrojumu?')) {
                        return;
                    }

                    const response = await fetch(button.dataset.url, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                    });

                    if (! response.ok) {
                        alert('Neizdevās dzēst vingrojumu.');
                        return;
                    }

                    button.closest('[data-exercise-row]').remove();
                });
            });
        </script>
    @endpush
</x-app-layout>
