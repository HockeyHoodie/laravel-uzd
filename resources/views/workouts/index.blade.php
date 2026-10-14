<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Treniņi
            </h2>
            <a href="{{ route('workouts.create') }}" class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700">
                Jauns treniņš
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="get" action="{{ route('workouts.index') }}" class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end">
                        <div class="flex-1">
                            <x-input-label for="search" value="Meklēt pēc nosaukuma" />
                            <x-text-input id="search" name="search" type="search" class="mt-1 block w-full" :value="$search" placeholder="Piemēram, kājas..." />
                        </div>
                        <x-primary-button type="submit">Meklēt</x-primary-button>
                    </form>

                    @if ($workouts->isEmpty())
                        <p class="text-gray-600">
                            Nav treniņu.
                            <a href="{{ route('workouts.create') }}" class="text-indigo-600 hover:underline">Izveido pirmo treniņu</a>.
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Nosaukums</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Datums</th>
                                        <th class="px-4 py-3 text-left font-medium text-gray-700">Vingrojumi</th>
                                        <th class="px-4 py-3 text-right font-medium text-gray-700">Darbības</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($workouts as $workout)
                                        <tr>
                                            <td class="px-4 py-3 font-medium text-gray-900">
                                                <a href="{{ route('workouts.show', $workout) }}" class="hover:underline">{{ $workout->title }}</a>
                                            </td>
                                            <td class="px-4 py-3 text-gray-600">{{ $workout->performed_at->format('Y-m-d') }}</td>
                                            <td class="px-4 py-3 text-gray-600">{{ $workout->exercises_count }}</td>
                                            <td class="px-4 py-3 text-right space-x-2">
                                                <a href="{{ route('workouts.edit', $workout) }}" class="text-indigo-600 hover:underline">Labot</a>
                                                <form action="{{ route('workouts.destroy', $workout) }}" method="post" class="inline" onsubmit="return confirm('Dzēst šo treniņu?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:underline">Dzēst</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $workouts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
