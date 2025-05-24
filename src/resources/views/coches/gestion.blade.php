{{-- resources/views/coches/gestion.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis coches') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-4xl mx-auto" x-data="crudCoches()">

        <!-- FLASH (éxito / error genérico) -->
        <template x-if="flash">
            <div x-text="flash"
                 :class="ok ? 'bg-green-600' : 'bg-red-600'"
                 class="mb-4 p-3 rounded text-white"></div>
        </template>

        <!-- FORMULARIO -->
        <form @submit.prevent="guardar"
              class="bg-white p-6 rounded shadow space-y-4">

            <input type="hidden" x-model="form.id">

            <!-- Marca -->
            <div>
                <x-input-label value="Marca"/>
                <x-text-input x-model="form.marca" class="w-full"/>
                <template x-if="errors.marca">
                    <p class="text-red-600 text-sm" x-text="errors.marca[0]"></p>
                </template>
            </div>

            <!-- Modelo -->
            <div>
                <x-input-label value="Modelo"/>
                <x-text-input x-model="form.modelo" class="w-full"/>
                <template x-if="errors.modelo">
                    <p class="text-red-600 text-sm" x-text="errors.modelo[0]"></p>
                </template>
            </div>

            <!-- Matrícula -->
            <div>
                <x-input-label value="Matrícula"/>
                <x-text-input x-model="form.matricula" class="w-full uppercase"/>
                <template x-if="errors.matricula">
                    <p class="text-red-600 text-sm" x-text="errors.matricula[0]"></p>
                </template>
            </div>

            <div class="flex gap-2">
                <x-primary-button x-text="form.id ? 'Actualizar' : 'Añadir'"/>
                <x-secondary-button type="button" @click="reset">Limpiar</x-secondary-button>
            </div>
        </form>

        <!-- LISTADO -->
        <div class="mt-8 bg-white p-6 rounded shadow">
            <template x-if="coches.length === 0">
                <p class="text-sm text-gray-500">Aún no tienes coches.</p>
            </template>

            <template x-for="c in coches" :key="c.id">
                <div class="border-b py-2 flex justify-between items-center">
                    <span x-text="`${c.marca} ${c.modelo} - ${c.matricula}`"></span>
                    <div class="space-x-2">
                        <button class="text-blue-600" @click="form={...c}; errors={}">Editar</button>
                        <button class="text-red-600"  @click="borrar(c.id)">Eliminar</button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Alpine.js -->
    <script>
        function crudCoches() {
            return {
                coches: [],
                form:   {id:null,marca:'',modelo:'',matricula:''},
                errors: {},
                flash:  '', ok:true,

                init()  { this.listar(); },

                headers() {
                    return {
                        'Content-Type':'application/json',
                        'Accept':'application/json',
                        'X-CSRF-TOKEN':'{{ csrf_token() }}'
                    };
                },

                listar() {
                    fetch('/api/coches',{headers:{'Accept':'application/json'}})
                        .then(r=>r.json()).then(j=>this.coches=j);
                },

                guardar() {
                    const url = this.form.id ? `/api/coches/${this.form.id}` : '/api/coches';
                    const m   = this.form.id ? 'PUT':'POST';

                    fetch(url,{method:m,headers:this.headers(),body:JSON.stringify(this.form)})
                    .then(async r=>{
                        if(r.status===422) throw await r.json();
                        if(!r.ok)          throw {message:'Error'};
                        return r.json();
                    })
                    .then(()=>{ this.reset(); this.listar(); this.flash='Guardado'; this.ok=true; })
                    .catch(e => { this.ok=false; this.handle(e); });
                },

                borrar(id) {
                    if(!confirm('¿Eliminar?')) return;
                    fetch(`/api/coches/${id}`,{method:'DELETE',headers:this.headers()})
                    .then(r=>{
                        if(!r.ok) throw {message:'Error'};
                        this.listar(); this.flash='Eliminado'; this.ok=true;
                    })
                    .catch(e=>{ this.ok=false; this.handle(e); });
                },

                reset() { this.form={id:null,marca:'',modelo:'',matricula:''}; this.errors={}; this.flash=''; },

                handle(e){
                    if(e.errors){ this.errors=e.errors; this.flash='Corrige los campos'; }
                    else { this.flash=e.message ?? 'Error inesperado'; }
                }
            }
        }
    </script>
</x-app-layout>