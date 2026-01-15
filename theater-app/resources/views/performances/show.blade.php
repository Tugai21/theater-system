<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="font-bold text-4xl text-red-600 mb-2 flex items-center justify-center gap-3">
                🎭 {{ $performance->title }}
            </h2>
            <p class="text-gray-600 text-xl">Театрално преживяване</p>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-red-50 via-yellow-50 to-red-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-2xl sm:rounded-3xl border border-red-100">
                <div class="p-12">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <div class="space-y-8">
                            <div class="relative">
                                <img src="{{ route('media.poster', basename($performance->image_path)) }}" class="w-full h-auto rounded-2xl shadow-2xl border-4 border-red-200">
                            </div>

                            <div class="bg-gradient-to-r from-red-600 to-red-700 text-black p-8 rounded-2xl shadow-xl">
                                <h3 class="text-2xl font-bold mb-4 flex items-center gap-3">
                                    📍 Място на провеждане
                                </h3>
                                <div class="space-y-2 text-lg">
                                    <p class="font-semibold text-xl text-black">{{ $performance->venue->name }}</p>
                                    <p class="text-black">{{ $performance->venue->address }}</p>
                                    <p class="text-black font-semibold">{{ $performance->venue->city }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="bg-white border-2 border-red-100 p-8 rounded-2xl shadow-lg">
                                <h3 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                    📅 Детайли за представлението
                                </h3>

                                <div class="space-y-6">
                                    <div class="flex items-center p-4 bg-red-50 rounded-xl border border-red-200">
                                        <span class="text-3xl mr-4">🕒</span>
                                        <div>
                                            <p class="font-semibold text-lg text-gray-900">Дата и час</p>
                                            <p class="text-red-600 font-bold text-xl">{{ $performance->date->format('d.m.Y H:i') }}</p>
                                        </div>
                                    </div>

                                    @if($performance->description)
                                        <div class="p-6 bg-yellow-50 rounded-xl border border-yellow-200">
                                            <h4 class="font-bold text-xl text-gray-900 mb-3 flex items-center gap-2">
                                                📖 Описание
                                            </h4>
                                            <p class="text-gray-700 text-lg leading-relaxed">{{ $performance->description }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Билети секция -->
                            <div class="bg-white border-2 border-red-100 p-8 rounded-2xl shadow-lg">
                                <h4 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                    🎫 Билети
                                </h4>
                                <p class="text-gray-600 text-lg mb-6">Изберете вашия билет за незабравимо преживяване</p>

                                @if($performance->ticketTypes->where('is_active', true)->isNotEmpty())
                                    <div class="space-y-4">
                                        @foreach($performance->ticketTypes->where('is_active', true) as $type)
                                            <div class="bg-gradient-to-r from-red-50 to-yellow-50 border-2 border-red-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <h5 class="font-bold text-xl text-gray-900 mb-1">{{ $type->name }}</h5>
                                                        @if($type->description)
                                                            <p class="text-gray-600 text-sm">{{ $type->description }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="text-3xl font-bold text-red-600">{{ number_format($type->price, 2) }} лв.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8 bg-red-50 rounded-xl border-2 border-red-200">
                                        <div class="text-4xl mb-2">🎪</div>
                                        <h5 class="text-lg font-bold text-gray-800 mb-1">Няма налични билети</h5>
                                        <p class="text-gray-600 text-sm">Билетите за това представление са изчерпани.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>