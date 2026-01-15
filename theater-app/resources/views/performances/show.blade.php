<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $performance->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="{{ route('media.poster', basename($performance->image_path)) }}" class="w-full h-auto rounded-lg shadow-md" alt="{{ $performance->title }}">
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $performance->title }}</h3>

                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-gray-600">
                                    <span class="mr-2">📍</span>
                                    <span class="font-medium">{{ $performance->venue->name }}, {{ $performance->venue->city }}</span>
                                </div>

                                <div class="flex items-center text-gray-600">
                                    <span class="mr-2">📆</span>
                                    <span class="font-medium">{{ $performance->date->format('d.m.Y H:i') }}</span>
                                </div>

                                @if($performance->description)
                                    <div class="text-gray-700">
                                        <p class="font-medium mb-2">Описание:</p>
                                        <p>{{ $performance->description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-6 mt-6">
                        <h4 class="text-xl font-semibold text-gray-900 mb-4">Билети</h4>

                        @if($performance->ticketTypes->where('is_active', true)->isNotEmpty())
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($performance->ticketTypes->where('is_active', true) as $type)
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                        <h5 class="font-semibold text-gray-900 mb-2">{{ $type->name }}</h5>
                                        <p class="text-2xl font-bold text-green-600 mb-2">{{ number_format($type->price, 2) }} лв.</p>
                                        <p class="text-sm text-gray-600">{{ $type->description ?? 'Няма описание' }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">Няма налични билети за тази постановка.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>