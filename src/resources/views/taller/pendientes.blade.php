{{--  Vista: Citas pendientes (rol “taller”)  --}}
<x-app-layout>
    {{-- ╭───────────────────────────  Título  ───────────────────────────╮ --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Citas pendientes') }}
        </h2>
    </x-slot>
    {{-- ╰───────────────────────────────────────────────────────────────╯ --}}

    {{-- Navegador interno (pestañas “Todas / Pendientes”) --}}
    <x-citas-nav />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Flash --}}
                    @if (session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($citas->isEmpty())
                        <p class="text-sm text-gray-500">
                            {{ __('No hay citas pendientes por asignar.') }}
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Cliente') }}
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Vehículo') }}
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Matrícula') }}
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Solicitada el') }}
                                        </th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Acciones') }}
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($citas as $cita)
                                        <tr>
                                            {{-- Cliente --}}
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $cita->user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $cita->user->email }}
                                                </div>
                                            </td>

                                            {{-- Vehículo --}}
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-900">
                                                    {{ $cita->marca }} {{ $cita->modelo }}
                                                </span>
                                            </td>

                                            {{-- Matrícula --}}
                                            <td class="px-4 py-4 whitespace-nowrap uppercase">
                                                <span class="text-sm text-gray-900">
                                                    {{ $cita->matricula }}
                                                </span>
                                            </td>

                                            {{-- Fecha de solicitud (created_at) --}}
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <span class="text-sm text-gray-900">
                                                    {{ $cita->created_at->format('d/m/Y H:i') }}
                                                </span>
                                            </td>

                                            {{-- Acciones --}}
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex items-center justify-end gap-4">
                                                    {{-- Ver --}}
                                                    <a href="{{ route('citas.show', $cita) }}"
                                                       class="text-indigo-600 hover:text-indigo-900">
                                                        {{ __('Ver') }}
                                                    </a>

                                                    {{-- Asignar / Editar --}}
                                                    <a href="{{ route('taller.citas.edit', $cita) }}"
                                                       class="text-blue-600 hover:text-blue-900">
                                                        {{ __('Asignar') }}
                                                    </a>

                                                    {{-- Eliminar --}}
                                                    <form action="{{ route('taller.citas.destroy', $cita) }}"
                                                          method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="text-red-600 hover:text-red-900"
                                                                onclick="return confirm('{{ __('¿Eliminar esta cita?') }}')">
                                                            {{ __('Eliminar') }}
                                                        </button>
                                                    </form>
                                                </div>
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