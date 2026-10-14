@csrf

<div class="space-y-4">
    <div>
        <x-input-label for="title" value="Nosaukums" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', isset($workout) ? $workout->title : '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>

    <div>
        <x-input-label for="performed_at" value="Datums" />
        <x-text-input id="performed_at" name="performed_at" type="date" class="mt-1 block w-full" :value="old('performed_at', isset($workout) ? $workout->performed_at?->format('Y-m-d') : now()->format('Y-m-d'))" required />
        <x-input-error class="mt-2" :messages="$errors->get('performed_at')" />
    </div>

    <div>
        <x-input-label for="notes" value="Piezīmes" />
        <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', isset($workout) ? $workout->notes : '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
    </div>
</div>
