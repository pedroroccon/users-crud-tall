<div>
    <!-- Add new user -->
    <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <img class="-ml-1 mr-2 h-5 w-5" src="{{ asset('svgs/arrow-left.svg') }}" alt="Ícone para voltar">
        Voltar
    </a>

    <div class="border bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6">
        <dl>
            <x-attribute title="Nome" :value="$user->name"/>
            <x-attribute title="Sobrenome" :value="$user->last_name"/>
            <x-attribute title="E-mail" :value="$user->email"/>
            <x-attribute title="CPF" :value="$user->cpf"/>
            <x-attribute title="Celular" :value="$user->phone"/>
            <x-attribute title="CEP" :value="$user->postcode"/>
            <x-attribute title="Endereço" :value="$user->address_complete"/>
            <x-attribute title="Complemento" :value="$user->address_additional"/>
            <x-attribute title="Cidade/Estado" :value="$user->city . '/' . $user->state"/>
            <x-attribute title="País" :value="$user->country"/>
        </dl>
    </div>
</div>