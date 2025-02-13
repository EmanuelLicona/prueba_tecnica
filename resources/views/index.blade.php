@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')
    {{-- Crear una bienvenida --}}
    <div class="container mt-4">
        
        <section class="bg-body-tertiary">
            <h1>Bienvenido {{ Auth::user()->name }}</h1>
            <p>Bienvenido al sistema de administración de productos</p>
        </section>

        <section class="row gap-2 ">

            @foreach ($categories as $category)
                <div class=" col-md-4 card" >
                    <img src="{{ $category->image ? ' data:image/jpeg;base64,' . $category->image : 'https://placehold.co/500' }}"
                        class="card-img-top" width="150px" height="150px" alt="Imagen">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->description ? $category->description : 'No hay descripción' }}</p>
                        <a href="{{ route('product.category', $category->id) }}" class="btn btn-primary">Productos({{ $category->products->where('state', true)->count() }})</a>
                    </div>
                </div>
            @endforeach

        </section>
    </div>
@endsection
