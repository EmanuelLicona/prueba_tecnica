@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')
    {{-- Crear una bienvenida --}}
    <div class="container mt-4">
        
        <section class="bg-body-tertiary">
            <h1>Bienvenido {{ Auth::user()->name }}</h1>
            <p>Bienvenido al sistema de administración</p>
        </section>
    </div>
@endsection
