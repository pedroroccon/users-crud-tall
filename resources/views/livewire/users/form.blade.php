<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      
    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
  
    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
  
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <form>
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6">
              <x-label name="Nome" attribute="name"/>
              <x-input label="Primeiro nome" attribute="name"/>
              @error('name') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>
            <div class="col-span-3">
              <x-label name="Sobrenome" attribute="last_name"/>
              <x-input label="Sobrenome" attribute="last_name"/>
              @error('last_name') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>
            <div class="col-span-3">
              <x-label name="E-mail" attribute="email"/>
              <x-input label="E-mail" attribute="email" type="email"/>
              @error('email') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>
            <div class="col-span-3">
              <x-label name="CPF" attribute="cpf"/>
              <x-input label="CPF" attribute="cpf"/>
              @error('cpf') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>
            <div class="col-span-3">
              <x-label name="Celular" attribute="phone"/>
              <x-input label="Celular" attribute="phone"/>
              @error('phone') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>

            <!-- Address -->
            <div class="col-span-2">
              <x-label name="CEP" attribute="postcode"/>
              <input wire:keydown.debounce.500ms="getPostcode()" wire:model="postcode" type="text" name="postcode" id="postcode" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              @error('postcode') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>
            <div class="col-span-4">
              <x-label name="Endereço" attribute="address"/>
              <input wire:model="address" type="text" name="address" id="address" class="bg-gray-200 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
              @error('address') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>
            <div class="col-span-2">
              <x-label name="Número" attribute="number"/>
              <x-input label="Número" attribute="number"/>
              @error('number') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>
            <div class="col-span-4">
              <x-label name="Bairro" attribute="district"/>
              <input wire:model="district" type="text" name="district" id="district" class="bg-gray-200 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
              @error('district') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>
            <div class="col-span-6">
              <x-label name="Complemento" attribute="address_additional"/>
              <x-input label="Complemento" attribute="address_additional"/>
              @error('address_additional') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>
            <div class="col-span-3">
              <x-label name="Cidade" attribute="city"/>
              <input wire:model="city" type="text" name="city" id="city" class="bg-gray-200 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
              @error('city') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>
            <div class="col-span-3">
              <x-label name="Estado" attribute="state"/>
              <input wire:model="state" type="text" name="state" id="state" class="bg-gray-200 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
              @error('state') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
            </div>

            <!-- Password -->
            <div x-data="{ hidePassword: true }" class="col-span-6">
              <label for="password" class="block text-sm font-medium text-gray-700">Digite sua senha</label>
              <input :type="hidePassword ? 'password' : 'text'" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              <a href="#" class="mt-3 inline-flex items-center text-sm font-medium" @click="hidePassword = !hidePassword">
                <svg class="mr-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Mostrar/Esconder
              </a>
            </div>

              <!-- Terms and conditions -->
              @if (empty($user_id))
                <div class="col-span-6">
                  <hr class="my-2">
                  <div class="flex items-start mt-6">
                    <div class="flex items-center h-5">
                      <input id="terms" name="terms" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                      <label for="terms" class="font-medium text-gray-700">Li e aceito os termos e condições</label>
                      <p class="text-gray-500">Marcando este campo você está de acordo com a nossa política de privacidade e nossos termos de uso da plataforma.</p>
                    </div>
                  </div>
                </div>
              @endif
            </div>
        </div>
  
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
          <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Salvar
          </button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            
          <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
            Cancelar
          </button>
        </span>
        </form>
      </div>
        
    </div>
  </div>
</div>