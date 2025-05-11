<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->role === 'taller' ? __('Todas las citas') : __('Mis citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($citas->isEmpty())
                    <p class="text-gray-600">No hay citas registradas.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                @if(auth()->user()->role === 'taller')
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                                @endif
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Marca</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modelo</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matrícula</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duración</th>
                                @if(auth()->user()->role === 'taller')
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($citas as $cita)
                                <tr>
                                    @if(auth()->user()->role === 'taller')
                                        <td class="px-4 py-2">{{ $cita->user->name }}</td>
                                    @endif
                                    <td class="px-4 py-2">{{ $cita->marca }}</td>
                                    <td class="px-4 py-2">{{ $cita->modelo }}</td>
                                    <td class="px-4 py-2">{{ $cita->matricula }}</td>
                                    <td class="px-4 py-2">{{ $cita->fecha ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $cita->hora ?? '-' }}</td>
                                    <td class="px-4 py-2">{{ $cita->duracion_estimada ? $cita->duracion_estimada . ' min' : '-' }}</td>

                                    @if(auth()->user()->role === 'taller')
                                        <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('taller.citas.edit', $cita) }}" class="btn btn-success">Editar</a>

                                        <form action="{{ route('taller.citas.destroy', $cita) }}" method="POST" onsubmit="return confirm('¿Eliminar esta cita?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>