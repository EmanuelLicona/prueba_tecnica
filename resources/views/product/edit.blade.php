@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')

    <div class="container mt-4 mx-auto" style="max-width: 800px;">
        <h1>Editar Producto</h1>
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

        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @method('PUT') 
            @csrf
            
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}">
            </div>

            {{-- categorias --}}
            <div class="form-group">
                <label for="categories">Categorias</label>
                <select class="form-control" id="categories" name="categories[]" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="state" name="state" checked>
                <label class="form-check-label" for="state">Estado</label>
            </div>
            <div>
                <a href="{{ route('product.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
                
                <button type="submit" class="btn btn-primary mt-3">Editar</button>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#categories').select2();
        });
    </script>
@endsection
