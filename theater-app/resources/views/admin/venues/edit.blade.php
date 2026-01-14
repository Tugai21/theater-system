<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Редакция на място
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.venues.update', $venue) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Име</label>
                        <input type="text" name="name" value="{{ old('name', $venue->name) }}" required 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Град</label>
                        <input type="text" name="city" value="{{ old('city', $venue->city) }}" required 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('city')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Адрес</label>
                        <input type="text" name="address" value="{{ old('address', $venue->address) }}" required 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('address')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Запази</button>
                        <a href="{{ route('admin.venues.index') }}" class="text-gray-600 underline">Отказ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>