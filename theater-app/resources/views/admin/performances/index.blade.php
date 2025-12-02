<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🎭 Админ Панел - Постановки
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between mb-6">
                <a href="{{ route('admin.performances.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                    ➕ Нова постановка
                </a>

                <form method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Търси по име, дата или място..." 
                           class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-64">
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded shadow hover:bg-gray-700">
                        🔍 Търси
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Плакат</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Име & Дата</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Място</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Цена</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($performances as $performance)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $performance->image_path) }}" class="w-16 h-24 object-cover rounded shadow">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $performance->title }}</div>
                                    <div class="text-sm text-gray-500">{{ $performance->date->format('d.m.Y') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $performance->venue->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $performance->venue->city }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ number_format($performance->ticket_price, 2) }} лв.
                                </td>
                                <td class="px-6 py-4 text-sm font-medium">
                                    <a href="{{ route('admin.performances.edit', $performance) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Редакция</a>
                                    
                                    <form method="POST" action="{{ route('admin.performances.destroy', $performance) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Сигурни ли сте, че искате да изтриете тази постановка?')">
                                            Изтрий
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Няма намерени постановки.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $performances->links() }}
            </div>
        </div>
    </div>
</x-app-layout>