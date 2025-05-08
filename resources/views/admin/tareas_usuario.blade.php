<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tareas de {{ $usuario->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 bg-white shadow sm:rounded-lg p-6">
            @if($tareas->count())
                <table class="table table-striped w-full">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Completada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tareas as $tarea)
                            <tr>
                                <td>{{ $tarea->titulo }}</td>
                                <td>{{ $tarea->descripcion }}</td>
                                <td>{{ $tarea->completada ? '✅' : '❌' }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('admin.tareas.editar', $tarea->id) }}" class="btn btn-sm btn-warning">Editar</a>

                                    <form action="{{ route('admin.tareas.eliminar', $tarea->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta tarea?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $tareas->links() }}
                </div>
            @else
                <div class="alert alert-info">Este usuario no tiene tareas.</div>
            @endif

            <a href="{{ route('admin.usuarios') }}" class="btn btn-secondary mt-4">← Volver al listado</a>
        </div>
    </div>
</x-app-layout>
