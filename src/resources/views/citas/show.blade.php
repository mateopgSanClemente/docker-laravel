{{--  Vista: Detalle de una cita  --}}
<x-app-layout>
    {{-- ───── Título ───── --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de la cita') }}
        </h2>
    </x-slot>

    {{-- ───── Contenido ───── --}}
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-6">

                    {{-- Datos del vehículo --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            {{ __('Vehículo') }}
                        </h3>
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
                        </div>
                    </div>

                    {{-- Datos de la cita --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            {{ __('Cita') }}
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">{{ __('Fecha') }}</span>
                                <div class="text-base">
                                    {{ $cita->fecha ? \Illuminate\Support\Carbon::parse($cita->fecha)->format('d/m/Y') : '—' }}
                                </div>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">{{ __('Hora') }}</span>
                                <div class="text-base">{{ $cita->hora ?? '—' }}</div>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">{{ __('Duración estimada') }}</span>
                                <div class="text-base">
                                    {{ $cita->duracion_estimada ? $cita->duracion_estimada . ' min' : '—' }}
                                </div>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">{{ __('Estado') }}</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $cita->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Acciones --}}
                    <div class="flex items-center justify-between">
                        {{-- Botón volver --}}
                        @if (auth()->user()->role === 'cliente')
                            <a href="{{ route('cliente.citas.index') }}"
                               class="text-sm text-gray-600 hover:text-gray-900">
                                {{ __('← Volver a mis citas') }}
                            </a>
                        @else
                            <a href="{{ route('taller.citas.index') }}"
                               class="text-sm text-gray-600 hover:text-gray-900">
                                {{ __('← Volver al listado') }}
                            </a>
                        @endif

                        {{-- Solo el taller ve “Editar” --}}
                        @if (auth()->user()->role === 'taller')
                            <x-primary-button>
                                <a href="{{ route('taller.citas.edit', $cita) }}">
                                    {{ __('Editar cita') }}
                                </a>
                            </x-primary-button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>