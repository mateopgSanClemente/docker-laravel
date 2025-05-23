{{-- resources/views/cliente/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Solicitar cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cliente.citas.store') }}" class="space-y-6">
                        @csrf

                        {{-- Marca --}}
                        <div>
                            <x-input-label for="marca" :value="__('Marca')" />
                            <x-text-input id="marca" name="marca" type="text"
                                          class="block mt-1 w-full"
                                          :value="old('marca')" required autofocus />
                            <x-input-error :messages="$errors->get('marca')" class="mt-2" />
                        </div>

                        {{-- Modelo --}}
                        <div>
                            <x-input-label for="modelo" :value="__('Modelo')" />
                            <x-text-input id="modelo" name="modelo" type="text"
                                          class="block mt-1 w-full"
                                          :value="old('modelo')" required />
                            <x-input-error :messages="$errors->get('modelo')" class="mt-2" />
                        </div>

                        {{-- Matrícula --}}
                        <div>
                            <x-input-label for="matricula" :value="__('Matrícula')" />
                            <x-text-input id="matricula" name="matricula" type="text"
                                          maxlength="10" class="block mt-1 w-full uppercase"
                                          :value="old('matricula')" required />
                            <x-input-error :messages="$errors->get('matricula')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Solicitar cita') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <p class="text-sm text-gray-500 mt-6">
                        {{ __('Una vez enviada la solicitud, el taller te asignará fecha y hora. Podrás consultarla en tu listado de citas.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>