@extends('layouts.auth')
@section('title', 'Prueba tecnica')
@section('content')
    <section class="d-flex align-items-center justify-content-center min-vh-100">
        <form class="w-100 m-auto border border-primary rounded shadow-sm p-4" style="max-width: 320px;" method="POST" action="{{ route('login') }}">
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3"> 
                <label for="inputPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="inputPassword">
            </div>
          
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>

    </section>

@endsection
