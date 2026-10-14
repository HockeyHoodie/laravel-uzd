<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100 text-gray-900">
        <div class="min-h-screen flex flex-col items-center justify-center px-4">
            <div class="max-w-lg text-center">
                <h1 class="text-3xl font-semibold tracking-tight">Treniņu žurnāls</h1>
                <p class="mt-4 text-gray-600">
                    Reģistrē treniņus, pievieno vingrojumus un seko progresam vienuviet.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center rounded-md bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-700">
                            Atvērt paneli
                        </a>
                        <a href="{{ route('workouts.index') }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Treniņi
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center rounded-md bg-gray-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-700">
                            Pieslēgties
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Reģistrēties
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </body>
</html>
