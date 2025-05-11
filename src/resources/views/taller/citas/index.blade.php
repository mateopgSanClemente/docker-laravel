<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                @if($citas->isEmpty())
                    <p class="text-gray-600">No hay citas registradas.</p>
                @else
                    <table class="w-full border">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Cliente</th>
                                <th class="border px-4 py-2">Marca</th>
                                <th class="border px-4 py-2">Modelo</th>
                                <th class="border px-4 py-2">Matrícula</th>
                                <th class="border px-4 py-2">Fecha</th>
                                <th class="border px-4 py-2">Hora</th>
                                <th class="border px-4 py-2">Duración</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($citas as $cita)
                                <tr>
                                    <td class="border px-4 py-2">{{ $cita->user->name }}</td>
                                    <td class="border px-4 py-2">{{ $cita->marca }}</td>
                                    <td class="border px-4 py-2">{{ $cita->modelo }}</td>
                                    <td class="border px-4 py-2">{{ $cita->matricula }}</td>
                                    <td class="border px-4 py-2">{{ $cita->fecha ?? '—' }}</td>
                                    <td class="border px-4 py-2">{{ $cita->hora ?? '—' }}</td>
                                    <td class="border px-4 py-2">{{ $cita->duracion_estimada ?? '—' }}</td>
                                    <td class="border px-4 py-2 flex space-x-2">
                                        <a href="{{ route('taller.citas.edit', $cita) }}" class="btn btn-success">Editar</a>

                                        <form action="{{ route('taller.citas.destroy', $cita) }}" method="POST" onsubmit="return confirm('¿Eliminar esta cita?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>