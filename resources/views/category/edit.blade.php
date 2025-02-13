@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')

    <div class="container mt-4">
        <h1>Editar Categoria</h1>
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

        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $category->name }}">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $category->description }}">
            </div>
            
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="state" name="state" @if ($category->state) checked @endif>
                <label class="form-check-label" for="state">Estado</label>
            </div>

            {{-- <button type="submit" class="btn btn-primary mt-3">Editar</button>
             --}}
             {{-- group buttons --}}
             <div class="">
                 <a href="{{ route('category.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
                <button type="submit" class="btn btn-primary mt-3">Editar</button>
            </div>

        </form>
    </div>  

@endsection

