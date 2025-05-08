<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="mb-4 text-center">👥 Lista de Usuarios</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Administrador</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->es_admin ? '✅ Sí' : '❌ No' }}</td>
                        <td>
                            <a href="{{ route('admin.usuarios.editar', $usuario->id) }}" class="btn btn-sm btn-warning">Editar</a>

                            <form action="{{ route('admin.usuarios.eliminar', $usuario->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</button>
                            </form>

                            <a href="{{ route('admin.usuarios.tareas', $usuario->id) }}" class="btn btn-sm btn-info">Ver Tareas</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $usuarios->links() }}
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('tareas.index') }}" class="btn btn-secondary">← Volver a Tareas</a>
    </div>
</div>
</body>
</html>
