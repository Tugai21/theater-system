<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="font-bold text-3xl text-red-600 mb-2 flex items-center justify-center gap-3">
                🎭 Предстоящи Постановки
            </h2>
            <p class="text-gray-600 text-lg">Открийте магията на театъра</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-red-50 to-yellow-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Form -->
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-2xl border border-red-100 mb-8">
                <div class="p-8">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">🔍 Намерете своето представление</h3>
                        <p class="text-gray-600">Търсете по заглавие, дата или място</p>
                    </div>
                    <form method="GET" action="{{ route('home') }}" class="flex gap-4 max-w-2xl mx-auto">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Например: Хамлет, София, 15.01..." class="w-full px-6 py-4 border-2 border-red-200 rounded-xl focus:ring-4 focus:ring-red-100 focus:border-red-400 transition-all duration-200 text-lg">
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 text-black px-8 py-4 rounded-xl hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-4 focus:ring-red-200 transition-all duration-200 font-semibold text-lg shadow-lg">
                            🎪 Търси
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($performances as $performance)
                    <a href="{{ route('performances.show', $performance) }}" class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-2xl hover:shadow-3xl sm:rounded-2xl border border-red-100 hover:border-red-300 transition-all duration-300 block group transform hover:-translate-y-2">
                        <div class="h-56 overflow-hidden bg-gradient-to-br from-red-100 to-yellow-100 relative">
                            <img src="{{ route('media.poster', basename($performance->image_path)) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute top-4 right-4 bg-red-600 text-black px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                🎟️ Билети
                            </div>
                        </div>

                        <div class="p-8">
                            <h3 class="font-bold text-3xl text-gray-900 mb-4 mt-4 group-hover:text-red-600 transition-colors duration-200">{{ $performance->title }}</h3>

                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-gray-700">
                                    <span class="mr-3 text-2xl">🏛️</span>
                                    <div>
                                        <span class="font-semibold text-lg">{{ $performance->venue->name }}</span>
                                        <br>
                                        <span class="text-gray-600">{{ $performance->venue->city }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center text-gray-700">
                                    <span class="mr-3 text-2xl">📅</span>
                                    <span class="font-semibold text-lg">{{ $performance->date->format('d.m.Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            @if($performances->isEmpty())
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">🎪</div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Все още няма предстоящи постановки</h3>
                    <p class="text-gray-600 text-lg">Следете за нови представления скоро!</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>