@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')
    {{-- Crear una bienvenida --}}
    <div class="container mt-4">
        <section>
            <h1>Bienvenido {{ Auth::user()->name }}</h1>
            <p>Bienvenido a la aplicación de prueba tecnica</p>
        </section>

        <section class="d-flex gap-2 flex-wrap">

            @foreach ($categories as $category)
                <div class="card" style="width: 18rem;">
                    <img src="{{ $category->image ? ' data:image/jpeg;base64,' . $category->image : 'https://placehold.co/500' }}"
                        class="card-img-top" width="150px" height="150px" alt="Imagen">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->description ? $category->description : 'No hay descripción' }}</p>
                        <a href="#" class="btn btn-primary">Productos</a>
                    </div>
                </div>
            @endforeach

        </section>
    </div>
@endsection
