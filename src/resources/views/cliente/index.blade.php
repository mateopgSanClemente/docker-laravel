{{-- resources/views/cliente/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-6 text-right">
                        <x-primary-button>
                            <a href="{{ route('cliente.citas.create') }}">
                                {{ __('Solicitar nueva cita') }}
                            </a>
                        </x-primary-button>
                    </div>

                    @if ($citas->isEmpty())
                        <p class="text-sm text-gray-500">
                            {{ __('Aún no tienes citas registradas.') }}
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        {{-- ▼ NUEVO encabezado de Matrícula --}}
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Marca / Modelo') }}
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Matrícula') }}
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Fecha') }}
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Hora') }}
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Estado') }}
                                        </th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Acciones') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($citas as $cita)
                                        <tr>
                                            {{-- Marca / Modelo --}}
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="text-sm font-medium text-gray-900">
                                                    {{ $cita->marca }} {{ $cita->modelo }}
                                                </span>
                                            </td>

                                            {{-- ▼ NUEVA celda de Matrícula --}}
                                            <td class="px-4 py-4 whitespace-nowrap uppercase">
                                                <span class="text-sm text-gray-900">
                                                    {{ $cita->matricula }}
                                                </span>
                                            </td>

                                            {{-- Fecha --}}
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-900">
                                                    {{ $cita->fecha ? \Illuminate\Support\Carbon::parse($cita->fecha)->format('d/m/Y') : '—' }}
                                                </span>
                                            </td>

                                            {{-- Hora --}}
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-900">
                                                    {{ $cita->hora ?? '—' }}
                                                </span>
                                            </td>

                                            {{-- Estado --}}
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{ $cita->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                                    {{ ucfirst($cita->estado) }}
                                                </span>
                                            </td>

                                            {{-- Acciones --}}
                                            <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('citas.show', $cita) }}"
                                                   class="text-indigo-600 hover:text-indigo-900">
                                                    {{ __('Ver') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>