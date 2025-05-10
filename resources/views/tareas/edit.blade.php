@extends('tareas.layout')

@section('content')
<div class="container py-5">
    <h2>✏️ Editar Tarea</h2>
    <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ $tarea->titulo }}" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $tarea->descripcion }}</textarea>
        </div>
        <div class="mb-3">
            <label for="prioridad" class="form-label">Prioridad</label>
            <select name="prioridad" id="prioridad" class="form-select" required>
                <option value="baja" {{ $tarea->prioridad == 'baja' ? 'selected' : '' }}>Baja</option>
                <option value="media" {{ $tarea->prioridad == 'media' ? 'selected' : '' }}>Media</option>
                <option value="alta" {{ $tarea->prioridad == 'alta' ? 'selected' : '' }}>Alta</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/validacion-tarea.js') }}"></script>
@endpush