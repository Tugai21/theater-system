<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="font-bold text-3xl text-red-600 mb-2 flex items-center justify-center gap-3">
                🎭 Админ Панел - Постановки
            </h2>
            <p class="text-gray-600 text-lg">Управлявайте театралните представления</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-red-50 to-yellow-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between mb-8">
                <a href="{{ route('admin.performances.create') }}" class="bg-gradient-to-r from-red-600 to-red-700 text-black px-8 py-4 rounded-xl shadow-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold text-lg flex items-center gap-2">
                    ➕ Нова постановка
                </a>

                <form method="GET" class="flex gap-4">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Търси по име, дата или място..."
                           class="border-2 border-red-200 focus:border-red-400 focus:ring-red-400 rounded-xl shadow-sm w-80 px-4 py-3 text-lg">
                    <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 text-black px-6 py-3 rounded-xl shadow-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold">
                        🔍 Търси
                    </button>
                </form>
            </div>

            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-2xl border border-red-100">
                <table class="min-w-full divide-y divide-red-200">
                    <thead class="bg-gradient-to-r from-red-600 to-red-700">
                        <tr>
                            <th class="px-8 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">🎨 Плакат</th>
                            <th class="px-8 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">🎭 Заглавие & Дата</th>
                            <th class="px-8 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">🏛️ Място</th>
                            <th class="px-8 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">🎫 Билети</th>
                            <th class="px-8 py-4 text-left text-xs font-bold text-black uppercase tracking-wider">⚙️ Действия</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-red-100">
                        @forelse($performances as $performance)
                            <tr class="hover:bg-red-50 transition-colors duration-200">
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <img src="{{ route('media.poster', basename($performance->image_path)) }}" class="w-20 h-28 object-cover rounded-lg shadow-lg border-2 border-red-200">
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-lg font-bold text-gray-900 mb-1">{{ $performance->title }}</div>
                                    <div class="text-sm text-red-600 font-semibold">{{ $performance->date->format('d.m.Y H:i') }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-semibold text-gray-900">{{ $performance->venue->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $performance->venue->city }}</div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="space-y-1">
                                        @foreach($performance->ticketTypes->where('is_active', true)->take(2) as $type)
                                            <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-semibold">
                                                {{ $type->name }}: {{ number_format($type->price, 2) }} лв.
                                            </span>
                                        @endforeach
                                        @if($performance->ticketTypes->where('is_active', true)->count() > 2)
                                            <span class="text-xs text-gray-600">+{{ $performance->ticketTypes->where('is_active', true)->count() - 2 }} още</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('admin.performances.edit', $performance) }}" class="bg-yellow-500 text-black px-4 py-2 rounded-lg hover:bg-yellow-600 transition-colors duration-200 font-semibold inline-flex items-center gap-1">
                                        ✏️ Редактирай
                                    </a>
                                    <form method="POST" action="{{ route('admin.performances.destroy', $performance) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-black px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200 font-semibold inline-flex items-center gap-1" onclick="return confirm('Сигурни ли сте, че искате да изтриете тази постановка?')">
                                            🗑️ Изтрий
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-12 text-center">
                                    <div class="text-6xl mb-4">🎭</div>
                                    <div class="text-xl font-bold text-gray-800 mb-2">Няма намерени постановки</div>
                                    <div class="text-gray-600">Добавете първата си театрална постановка!</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $performances->links() }}
            </div>
        </div>
    </div>
</x-app-layout>