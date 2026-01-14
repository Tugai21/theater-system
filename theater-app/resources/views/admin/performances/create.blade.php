<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Добави нова постановка
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.performances.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Име на постановка</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Дата на провеждане</label>
                        <input type="date" name="date" value="{{ old('date') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Място на провеждане</label>
                        <select name="venue_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1">
                            @foreach($venues as $venue)
                                <option value="{{ $venue->id }}" {{ old('venue_id') == $venue->id ? 'selected' : '' }}>
                                    {{ $venue->name }} ({{ $venue->city }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Цени на типове билети (лв.)</label>

                        <div class="grid grid-cols-2 gap-3 mt-2">
                            <div>
                                <label class="block text-sm text-gray-700">Стандартен</label>
                                <input type="number" step="0.01" name="ticket_types[standard]" value="{{ old('ticket_types.standard') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1">
                            </div>

                            <div>
                                <label class="block text-sm text-gray-700">Студент</label>
                                <input type="number" step="0.01" name="ticket_types[student]" value="{{ old('ticket_types.student') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1">
                            </div>

                            <div>
                                <label class="block text-sm text-gray-700">Дете</label>
                                <input type="number" step="0.01" name="ticket_types[child]" value="{{ old('ticket_types.child') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1">
                            </div>

                            <div>
                                <label class="block text-sm text-gray-700">VIP</label>
                                <input type="number" step="0.01" name="ticket_types[vip]" value="{{ old('ticket_types.vip') }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full mt-1">
                            </div>
                        </div>

                        <p class="text-xs text-gray-500 mt-2">Оставете празно да не се предлагат.</p>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Плакат (Снимка)</label>
                        <input type="file" name="photo" class="block w-full text-sm text-gray-500 mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('admin.performances.index') }}" class="text-gray-600 underline mr-4 mt-2">Отказ</a>
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded shadow hover:bg-green-700">
                            Запази
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>