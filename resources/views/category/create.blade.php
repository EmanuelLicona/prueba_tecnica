@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')

    <div class="container">
        <h1>Crear Categoria</h1>
        {{-- errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
            </div>
            
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="state" name="state" checked>
                <label class="form-check-label" for="state">Estado</label>
            </div>
            <div>
                <a href="{{ route('category.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
                
                <button type="submit" class="btn btn-primary mt-3">Crear</button>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
