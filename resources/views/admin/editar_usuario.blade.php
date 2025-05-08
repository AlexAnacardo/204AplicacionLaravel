<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Usuario</title>
    <!-- Aquí puedes agregar el enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Editar Usuario: {{ $usuario->name }}</h2>

        <form method="POST" action="{{ route('admin.usuarios.actualizar', $usuario->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ $usuario->name }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $usuario->email }}">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="es_admin" value="1" class="form-check-input" id="adminCheck"
                    {{ $usuario->es_admin ? 'checked' : '' }}>
                <label class="form-check-label" for="adminCheck">¿Es administrador?</label>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="{{ route('admin.usuarios') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
