<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👥 Админ Панел - Потребители
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between mb-6">
                <h3 class="text-lg font-semibold">Управление на потребители</h3>

                <form method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Търси по име или имейл..." 
                           class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-64">
                     <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 text-black px-6 py-3 rounded-xl shadow-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 font-semibold">
                        🔍 Търси
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Име</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Имейл</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Администратор</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($user->is_admin) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                        @if($user->is_admin) ✅ Да @else ❌ Не @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form method="POST" action="{{ route('admin.users.toggleAdmin', $user) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="@if($user->is_admin) bg-red-600 hover:bg-red-700 @else bg-green-600 hover:bg-green-700 @endif text-black px-3 py-1 rounded shadow text-sm">
                                            @if($user->is_admin) Премахни админ @else Направи админ @endif
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-600">
                                    Няма намерени потребители
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
