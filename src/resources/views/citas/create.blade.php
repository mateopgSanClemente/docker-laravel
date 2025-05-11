<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear nueva cita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('citas.store') }}">
                    @csrf

                    <div>
                        <label>Marca:</label>
                        <input type="text" name="marca" class="form-input w-full" required>
                    </div>

                    <div class="mt-4">
                        <label>Modelo:</label>
                        <input type="text" name="modelo" class="form-input w-full" required>
                    </div>

                    <div class="mt-4">
                        <label>Matrícula:</label>
                        <input type="text" name="matricula" class="form-input w-full" required>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="btn btn-primary">
                            Crear cita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>