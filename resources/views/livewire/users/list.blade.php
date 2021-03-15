<div>

    <!-- Add new user -->
    <x-button wire:click="create()" type="primary">
        <img  class="-ml-1 mr-2 h-5 w-5" src="{{ asset('svgs/user-add.svg') }}" alt="Ícone para adicionar usuário">Novo usuário
    </x-button>

    <div class="border bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6">

        <!-- Feedback messages -->
        @if (session()->has('message'))
            <x-message>
                {{ session()->get('message') }}</span>
            </x-message>
        @endif
        
        <!-- Modal form -->
        @if($isOpen)
            @include('livewire.users.form')
        @endif
        
        <div class="overflow-y-scroll md:overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ asset('images/profile.png') }}" width="40" height="40" alt="Profile">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium underline text-indigo-600 hover:no-underline"><a href="{{ $user->path() }}">{{ $user->name }} {{ $user->last_name }}</a></div>
                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">{{ $user->address }}, {{ $user->number }} - {{ $user->district }}</div>
                                <div class="text-sm text-gray-500">{{ $user->city }}/{{ $user->state }} - CEP {{ $user->postcode }}</div>
                            </td>
                            <td class="border-l px-4 py-2 text-center whitespace-nowrap">
                                <button wire:click="edit({{ $user->id }})" class="hover:text-blue-700 text-blue-500 p-2">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $user->id }})" class="hover:text-red-700 text-red-500 p-2">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <hr>
            <div class="p-5">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>