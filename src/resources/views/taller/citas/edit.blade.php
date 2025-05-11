<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-sm">
                <form method="POST" action="{{ route('taller.citas.update', $cita->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Marca</label>
                        <input type="text" name="marca" value="{{ old('marca', $cita->marca) }}" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Modelo</label>
                        <input type="text" name="modelo" value="{{ old('modelo', $cita->modelo) }}" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Matrícula</label>
                        <input type="text" name="matricula" value="{{ old('matricula', $cita->matricula) }}" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Fecha</label>
                        <input type="date" name="fecha" value="{{ old('fecha', $cita->fecha) }}" class="form-input w-full">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Hora</label>
                        <input type="time" name="hora" value="{{ old('hora', $cita->hora) }}" class="form-input w-full">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Duración estimada (minutos)</label>
                        <input type="number" name="duracion_estimada" value="{{ old('duracion_estimada', $cita->duracion_estimada) }}" class="form-input w-full">
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary">
                            Actualizar cita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>