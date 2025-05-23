@props([
    // El rol se pasa desde la vista o el layout
    'role' => auth()->check() ? auth()->user()->role : null,
])

<nav class="mb-8 flex gap-4">
    {{-- CLIENTE --}}
    @if ($role === 'cliente')
        <x-nav-link :href="route('cliente.citas.index')"
                    :active="request()->routeIs('cliente.citas.index')">
            {{ __('Mis citas') }}
        </x-nav-link>

        <x-nav-link :href="route('cliente.citas.create')"
                    :active="request()->routeIs('cliente.citas.create')">
            {{ __('Solicitar cita') }}
        </x-nav-link>
    @endif

    {{-- TALLER --}}
    @if ($role === 'taller')
        <x-nav-link :href="route('taller.citas.index')"
                    :active="request()->routeIs('taller.citas.index')">
            {{ __('Todas las citas') }}
        </x-nav-link>

        <x-nav-link :href="route('taller.citas.pendientes')"
                    :active="request()->routeIs('taller.citas.pendientes')">
            {{ __('Pendientes') }}
        </x-nav-link>
    @endif
</nav>