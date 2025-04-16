@extends('tareas.layout')

@section('content')
<div class="container py-5">
    <div class="alert alert-danger">
        <h4 class="alert-heading">¿Eliminar tarea?</h4>
        <p>¿Estás seguro de que deseas eliminar la tarea <strong>"{{ $tarea->titulo }}"</strong>?</p>
        <hr>
        <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Sí, eliminar</button>
            <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
