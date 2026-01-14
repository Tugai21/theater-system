<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Редакция на постановка
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>@foreach ($errors->all() as $error) <li>• {{ $error }}</li> @endforeach</ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.performances.update', $performance) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4 text-center">
                        <img src="{{ route('media.poster', basename($performance->image_path)) }}" class="h-40 mx-auto rounded shadow">
                        <p class="text-xs text-gray-500 mt-1">Текущ плакат</p>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Име</label>
                        <input type="text" name="title" value="{{ old('title', $performance->title) }}" class="border-gray-300 rounded-md w-full mt-1">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Дата</label>
                        <input type="date" name="date" value="{{ old('date', $performance->date->format('Y-m-d')) }}" class="border-gray-300 rounded-md w-full mt-1">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Място</label>
                        <select name="venue_id" class="border-gray-300 rounded-md w-full mt-1">
                            @foreach($venues as $venue)
                                <option value="{{ $venue->id }}" {{ old('venue_id', $performance->venue_id) == $venue->id ? 'selected' : '' }}>
                                    {{ $venue->name }} ({{ $venue->city }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Цена</label>
                        <input type="number" step="0.01" name="ticket_price" value="{{ old('ticket_price', $performance->ticket_price) }}" class="border-gray-300 rounded-md w-full mt-1">
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Смени Плакат (Опционално)</label>
                        <input type="file" name="photo" class="block w-full text-sm text-gray-500 mt-1">
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.performances.index') }}" class="text-gray-600 underline mr-4 mt-2">Отказ</a>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700">
                            Обнови
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>