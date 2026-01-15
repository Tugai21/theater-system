<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="font-bold text-3xl text-red-600 mb-2 flex items-center justify-center gap-3">
                🏛️ Админ Панел - Театрални Места
            </h2>
            <p class="text-gray-600 text-lg">Управлявайте местата за представления</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-red-50 via-yellow-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-8">
                <a href="{{ route('admin.venues.create') }}" class="bg-gradient-to-r from-red-600 to-red-700 text-black px-8 py-4 rounded-xl shadow-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold text-lg flex items-center gap-2">
                    ➕ Ново място
                </a>

                <form method="GET" class="flex gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Търси по име, град или адрес..." 
                           class="border-2 border-red-200 focus:border-red-400 focus:ring-4 focus:ring-red-100 rounded-xl shadow-sm w-80 px-6 py-4 text-lg transition-all duration-200">
                    <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 text-black px-6 py-3 rounded-xl shadow-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold">
                        🔍 Търси
                    </button>
                </form>
            </div>

            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-2xl border border-red-100">
                <table class="min-w-full divide-y divide-red-200">
                    <thead class="bg-gradient-to-r from-red-600 to-red-700">
                        <tr>
                            <th class="px-8 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">🏛️ Име</th>
                            <th class="px-8 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">📍 Град</th>
                            <th class="px-8 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">📌 Адрес</th>
                            <th class="px-8 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">⚙️ Действия</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-red-100">
                        @forelse($venues as $venue)
                            <tr class="hover:bg-red-50 transition-colors duration-200">
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <div class="text-lg font-bold text-gray-900">{{ $venue->name }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-lg text-red-600 font-semibold">{{ $venue->city }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm text-gray-600">{{ $venue->address }}</div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('admin.venues.edit', $venue) }}" class="bg-yellow-500 text-black px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors duration-200 font-semibold inline-flex items-center gap-1">
                                        ✏️ Редактирай
                                    </a>
                                    <form method="POST" action="{{ route('admin.venues.destroy', $venue) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-black px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200 font-semibold inline-flex items-center gap-1" onclick="return confirm('Сигурни ли сте, че искате да изтриете това място?')">
                                            🗑️ Изтрий
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-8 text-center">
                                    <div class="text-4xl mb-2">🏛️</div>
                                    <h5 class="text-lg font-bold text-gray-800 mb-1">Няма добавени места</h5>
                                    <p class="text-gray-600 text-sm">Добавете първото си театрално място.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $venues->links() }}
            </div>
        </div>
    </div>
</x-app-layout>