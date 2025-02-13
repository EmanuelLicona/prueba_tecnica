@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')
    {{-- Crear una bienvenida --}}
    <div class="container mt-4">
        <section>
            <h1>Categoria: {{ $category->name }}</h1>
          
        </section>

        <section class="d-flex gap-2 flex-wrap">

            @if ($products->isEmpty())
                <div class="alert alert-warning w-100">
                    <h4>No hay productos en esta categoria</h4>
                </div>

            @endif

            @foreach ($products as $product)
                <div class="card" style="width: 18rem;">
                    <img src="{{ $product->image ? ' data:image/jpeg;base64,' . $product->image : 'https://placehold.co/500' }}"
                        class="card-img-top" width="150px" height="150px" alt="Imagen">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description ? $product->description : 'No hay descripción' }}</p>
                    </div>
                </div>
            @endforeach

        </section>
    </div>
@endsection
