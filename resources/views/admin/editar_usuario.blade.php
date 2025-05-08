<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Usuario: {{ $usuario->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('admin.usuarios.actualizar', $usuario->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Nombre</label>
                    <input type="text" name="name" class="form-control w-full border-gray-300 rounded" value="{{ $usuario->name }}">
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Email</label>
                    <input type="email" name="email" class="form-control w-full border-gray-300 rounded" value="{{ $usuario->email }}">
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="es_admin" value="1" class="form-check-input" id="adminCheck"
                        {{ $usuario->es_admin ? 'checked' : '' }}>
                    <label class="form-check-label" for="adminCheck">¿Es administrador?</label>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="{{ route('admin.usuarios') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
