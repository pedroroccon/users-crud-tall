<x-modal>
	<form>
		<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
			<div class="grid grid-cols-6 gap-6">
				<div class="col-span-6">
					<x-input wire:model="name" label="Primeiro nome" attribute="name"/>
					@error('name') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
				</div>
				<div class="col-span-3">
					<x-input wire:model="last_name" label="Sobrenome" attribute="last_name"/>
					@error('last_name') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
				</div>
				<div class="col-span-3">
					<x-input wire:model="email" label="E-mail" attribute="email" type="email"/>
					@error('email') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
				</div>
				<div class="col-span-3">
					<div x-data="{ maskOptions: '000.000.000-00' }" x-init="IMask($refs.cpf, { mask: maskOptions })">
						<x-input x-ref="cpf" wire:model="cpf" label="CPF" attribute="cpf"/>
						@error('cpf') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
					</div>
				</div>
				<div class="col-span-3">
					<div x-data="{ maskOptions: '(00) 0 0000-0000' }" x-init="IMask($refs.phone, { mask: maskOptions })">
						<x-input x-ref="phone" wire:model="phone" label="Celular (com DDD)" attribute="phone"/>
						@error('phone') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
					</div>
				</div>

				<!-- Address -->
				<div class="col-span-2">
					<!--
						We use .debounce here to prevent unnecessary 
						requests to ViaCEP servers.
						-->
					<div x-data="{ maskOptions: '00000-000' }" x-init="IMask($refs.postcode, { mask: maskOptions })">
						<x-input x-ref="postcode" wire:model="postcode" label="CEP" attribute="postcode" wire:keydown.debounce.500ms="getPostcode()"/>
						@error('postcode') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
					</div>
				</div>
				<div class="col-span-4">
					<x-input wire:model="address" label="Endereço" attribute="address" readonly="true"/>
					@error('address') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
				</div>
				<div class="col-span-2">
					<x-input wire:model="number" label="Número" attribute="number"/>
					@error('number') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
				</div>
				<div class="col-span-4">
					<x-input wire:model="district" label="Bairro" attribute="district" readonly="true"/>
					@error('district') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
				</div>
				<div class="col-span-6">
					<x-input wire:model="address_additional" label="Complemento" attribute="address_additional"/>
					@error('address_additional') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
				</div>
				<div class="col-span-3">
					<x-input wire:model="city" label="Cidade" attribute="city" readonly="true"/>
					@error('city') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
				</div>
				<div class="col-span-3">
					<x-input wire:model="state" label="Estado" attribute="state" readonly="true"/>
					@error('state') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
				</div>

				<!-- Password -->
				<div x-data="{ hidePassword: true }" class="col-span-6">
					<x-label attribute="password" name="Digite sua senha"/>
					<input :type="hidePassword ? 'password' : 'text'" wire:model="password"" name="password" value="" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
					@error('password') <small class="text-red-500 mt-2">{{ $message }}</small>@enderror
					<div class="block">
						<a href="#" class="mt-3 w-100 inline-flex items-center text-sm font-medium" @click.prevent="hidePassword = !hidePassword">
							<img class="mr-2" src="{{ asset('svgs/eye.svg') }}" width="16" height="16" alt="Ícone de cadeado">
							Mostrar/Esconder
						</a>
					</div>
				</div>

				@if (empty($user_id))
					<!-- Terms and conditions -->
					<div class="col-span-6">
						<hr class="my-2">
						<div class="flex items-start mt-6">
							<div class="flex items-center h-5">
								<input id="terms" name="terms" value="1" type="checkbox" wire:model="terms" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
							</div>
							<div class="ml-3 text-sm">
								<x-label attribute="terms" name="Li e aceito os termos e condições"/>
								<p class="text-gray-500">Marcando este campo você está de acordo com a nossa política de privacidade e nossos termos de uso da plataforma.</p>
								@error('terms') <small class="block text-red-500 mt-2">{{ $message }}</small>@enderror
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
		<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
			<span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
				<x-button type="success" wire:click.prevent="store()">Salvar</x-button>
			</span>
			<span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
				<x-button wire:click="closeModal()">Cancelar</x-button>
			</span>
		</div>
	</form>
</x-modal>