{{--  Vista: edición de cita (rol “taller”)  --}}
<x-app-layout>
    {{-- ───── Título ───── --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar cita') }}
        </h2>
    </x-slot>

    {{-- Navegador interno (opcional) --}}
    <x-citas-nav />

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-8">

                    {{-- Datos del vehículo (solo lectura) --}}
                    <div class="space-y-2">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('Vehículo') }}</h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">{{ __('Marca') }}</span>
                                <div class="text-base">{{ $cita->marca }}</div>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">{{ __('Modelo') }}</span>
                                <div class="text-base">{{ $cita->modelo }}</div>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">{{ __('Matrícula') }}</span>
                                <div class="text-base uppercase">{{ $cita->matricula }}</div>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">{{ __('Cliente') }}</span>
                                <div class="text-base">{{ $cita->user->name }} ({{ $cita->user->email }})</div>
                            </div>
                        </div>
                    </div>

                    {{-- Formulario de edición --}}
                    <form method="POST" action="{{ route('taller.citas.update', $cita) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Fecha --}}
                        <div>
                            <x-input-label for="fecha" :value="__('Fecha')" />
                            <x-text-input id="fecha"
                                          name="fecha"
                                          type="date"
                                          class="block mt-1 w-full"
                                          :value="old('fecha', $cita->fecha)"
                                          required />
                            <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                        </div>

                        {{-- Hora --}}
                        <div>
                            <x-input-label for="hora" :value="__('Hora')" />
                            <x-text-input id="hora"
                                          name="hora"
                                          type="time"
                                          class="block mt-1 w-full"
                                          :value="old('hora', $cita->hora)"
                                          required />
                            <x-input-error :messages="$errors->get('hora')" class="mt-2" />
                        </div>

                        {{-- Duración estimada --}}
                        <div>
                            <x-input-label for="duracion_estimada" :value="__('Duración (minutos)')" />
                            <x-text-input id="duracion_estimada"
                                          name="duracion_estimada"
                                          type="number"
                                          min="1"
                                          class="block mt-1 w-full"
                                          :value="old('duracion_estimada', $cita->duracion_estimada)"
                                          required />
                            <x-input-error :messages="$errors->get('duracion_estimada')" class="mt-2" />
                        </div>

                        {{-- Estado (oculto → asignada) --}}
                        <input type="hidden" name="estado" value="asignada">

                        {{-- Botones --}}
                        <div class="flex items-center justify-between">
                            <a href="{{ route('taller.citas.index') }}"
                               class="text-sm text-gray-600 hover:text-gray-900">
                                {{ __('← Volver al listado') }}
                            </a>

                            <x-primary-button>
                                {{ __('Guardar cambios') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>