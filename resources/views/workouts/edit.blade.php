<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Labot treniņu
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="post" action="{{ route('workouts.update', $workout) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        @include('workouts._form', ['workout' => $workout])

                        <div class="flex items-center gap-4">
                            <x-primary-button>Saglabāt</x-primary-button>
                            <a href="{{ route('workouts.show', $workout) }}" class="text-sm text-gray-600 hover:underline">Atcelt</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
