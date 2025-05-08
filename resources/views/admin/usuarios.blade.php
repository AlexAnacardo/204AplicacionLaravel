<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Usuarios</title>
    <!-- Aquí puedes agregar el enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">LaravelApp</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.usuarios') }}">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.tareas') }}">Tareas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container py-4">
        <h2>Lista de Usuarios</h2>

        @foreach($usuarios as $usuario)
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p>{{ $usuario->name }} ({{ $usuario->email }})</p>

            <div>
                <!-- Enlace para ver las tareas -->
                <a href="{{ route('admin.usuarios.tareas', $usuario->id) }}" class="btn btn-info btn-sm me-2">Ver Tareas</a>

                <!-- Botones de edición y eliminación -->
                <a href="{{ route('admin.usuarios.editar', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('admin.usuarios.eliminar', $usuario->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
