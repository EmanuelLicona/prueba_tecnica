@extends('layouts.auth')
@section('title', 'Prueba tecnica')
@section('content')
    <section class="d-flex align-items-center justify-content-center min-vh-100">
        <form class="w-100 m-auto border border-primary rounded shadow-sm p-4" style="max-width: 320px;" method="POST" action="{{ route('executeRegister') }}">
            @csrf
            <h2 class="mb-4">Crear una cuenta</h2>
            
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="inputName" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="inputName" name="name">
            </div>

            <div class="mb-3"> 
                <label for="inputPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="inputPassword" name="password">
            </div>

            <div class="mb-3"> 
                <label for="inputPassword" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" id="inputPassword" name="password_confirmation">
            </div>
            
            <button type="submit" class="btn btn-primary">Crear cuenta</button>

            
        </form>

    </section>

@endsection
