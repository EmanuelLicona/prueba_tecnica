@extends('layouts.auth')
@section('title', 'Register records')
@section('content')




    <section class="d-flex flex-column align-items-center justify-content-center min-vh-100">


        <form class="w-100 m-auto border border-primary rounded shadow-sm p-4" style="max-width: 320px;" method="POST"
            action="{{ route('executeRegister') }}">
            @csrf
            <h2 class="mb-4">Crear una cuenta</h2>

            <div class="mb-3">
                <label for="inputEmail" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp">

                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif

            </div>

            <div class="mb-3">
                <label for="inputName" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="inputName" name="name">

                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="inputPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="inputPassword" name="password">

                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="inputPassword" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" id="inputPassword" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif

            </div>

            <div class="mt-3 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Crear cuenta</button>
                <a href="{{ route('login') }}" class="btn btn-secondary">Cancelar</a>
            </div>


        </form>

    </section>

@endsection
