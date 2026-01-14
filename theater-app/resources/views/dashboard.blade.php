<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📅 Последни Постановки
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($performances as $performance)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                        <div class="h-48 overflow-hidden bg-gray-100">
                            <img src="{{ route('media.poster', basename($performance->image_path)) }}" class="w-full h-full object-cover">
                        </div>
                        
                        <div class="p-6">
                            <h3 class="font-bold text-xl text-gray-900 mb-2">{{ $performance->title }}</h3>
                            
                            <div class="flex items-center text-gray-600 mb-1">
                                <span class="mr-2">📍</span>
                                <span>{{ $performance->venue->name }}, {{ $performance->venue->city }}</span>
                            </div>
                            
                            <div class="flex items-center text-gray-600 mb-4">
                                <span class="mr-2">📆</span>
                                <span>{{ $performance->date->format('d.m.Y') }}</span>
                            </div>

                            <div class="flex justify-between items-center border-t pt-4">
                                <span class="text-green-600 font-bold text-lg">{{ number_format($performance->ticket_price, 2) }} лв.</span>
                                <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">Билети</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($performances->isEmpty())
                <p class="text-center text-gray-500 mt-10">Все още няма добавени постановки.</p>
            @endif

        </div>
    </div>
</x-app-layout>