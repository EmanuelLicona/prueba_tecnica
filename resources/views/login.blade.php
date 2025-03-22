@extends('layouts.auth')
@section('title', 'Prueba tecnica')
@section('content')
    <section class="d-flex align-items-center justify-content-center min-vh-100">
        <form class="w-100 m-auto border border-primary rounded shadow-sm p-4" style="max-width: 320px;" method="POST"
            action="{{ route('executeLogin') }}">

            {{-- error messages --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf
            <h2 class="mb-4">Iniciar sesión</h2>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp"
                    value="{{ old('email') }}" required>
            

            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="inputPassword" name="password" required>
            </div>

  
            {{-- <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Recordarme
                </label>
            </div> --}}
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>

            <div class="text-center mt-3">
                {{-- <a href="{{ route('register') }}" class="text-decoration-none">¿No tienes cuenta? Registrate</a> --}}
            </div>
        </form>

    </section>

@endsection
