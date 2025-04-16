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
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/validacion-tarea.js') }}"></script>
@endpush