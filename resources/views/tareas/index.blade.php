<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tareas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="mb-4 text-center">📋 Lista de Tareas</h1>

    @if($tareas && $tareas->count())  <!-- Verificamos si $tareas no es null y si tiene elementos -->
        <div class="text-center mb-3">
            @if ($mostrarCompletadas)
                <a href="{{ route('tareas.index') }}" class="btn btn-primary">
                    🔙 Ver tareas sin completar
                </a>
            @else
                <a href="{{ route('tareas.index', ['completadas' => 1]) }}" class="btn btn-secondary">
                    ✅ Ver tareas completadas
                </a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-sm rounded">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                        <th>Cambiar estado</th>
                        <th>Fecha creacion</th>
                        <th>Completada en</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tareas as $tarea)
                        <tr>
                            <td>{{ $tarea->titulo }}</td>
                            <td>{{ $tarea->descripcion }}</td>
                            <td>
                                @if (!$tarea->completada)
                                    <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                @endif
                                <a href="{{ route('tareas.confirmDelete', $tarea->id) }}" class="btn btn-sm btn-danger">
                                    Eliminar
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('tareas.toggleEstado', $tarea->id) }}">
                                    @if (!$tarea->completada)
                                        <img src="{{ asset('images/TareaCompletada.png') }}" alt="Completada" width="50">
                                    @endif
                                </a>
                            </td>
                            <td>
                                {{ $tarea->created_at }}
                            </td>
                            <td>
                                @if ($tarea->completada)
                                    {{ $tarea->updated_at }}
                                @else
                                    Sin completar
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $tareas->withQueryString()->links() }}
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center" role="alert">
            No hay tareas registradas.
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('tareas.create') }}" class="btn btn-success">
            + Nueva Tarea
        </a>
    </div>
    <form class="text-center mb-3" method="POST" action="{{ route('logout') }}">
        @csrf
    <button type="submit" class="btn btn-danger">Cerrar sesión</button>
</form>

</div>

<!-- Bootstrap JS (opcional, para futuras funcionalidades) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
