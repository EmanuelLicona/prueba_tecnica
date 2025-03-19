@extends('layouts.auth')

@section('title', 'Prueba tecnica')
@section('content')
    <section class="d-flex align-items-center justify-content-center min-vh-100">
        <form class="w-100 m-auto border border-primary rounded shadow-sm p-4" style="max-width:1000px;" method="POST"
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


            <h2 class="mb-4">Formulario de registro</h2>
            <section class="flex flex-col gap-4 justify-between">
                
                <div class="">
                    <label for="inputName" class="form-label">Nombre: </label>
                    <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name') }}"
                        required>
                </div>
    
                <div class="">
                    <label for="inputBirthday" class="form-label">Fecha de nacimiento: </label>
                    <input type="date" class="form-control" id="inputBirthday" name="birthday" value="{{ old('birthday') }}"
                        required>
                </div>
    
            </section>

            {{-- Pertenece a una iglesia --}}

            <div class="mb-3">
                <label for="inputReligion" class="form-label">Pertenece a una iglesia? </label>
                <select class="form-control" id="inputReligion" name="religion">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>

            {{-- Iglesia --}}
            <div class="mb-3">
                <label for="inputChurch" class="form-label">Iglesia: </label>
                <input type="text" class="form-control" id="inputChurch" name="church" value="{{ old('church') }}"
                    required>
            </div>

            {{-- Padece enfermedad si o no  --}}
            <div class="mb-3">
                <label for="inputSymptoms" class="form-label">¿Padece alguna condicion medica? </label>
                <input type="text" class="form-control" id="inputSymptoms" name="symptoms" value="{{ old('symptoms') }}"
                    required>
            </div>

            {{-- Espasifique si padece enfermedad --}}
            <div class="mb-3">
                <label for="inputSymptoms" class="form-label">Padese de algun alergia? </label>
                <select class="form-control" id="inputSymptoms" name="symptoms">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </div>

            {{-- Alergia --}}
            <div class="mb-3">
                <label for="inputSymptoms" class="form-label">Alergia: </label>
                <input type="text" class="form-control" id="inputSymptoms" name="symptoms" value="{{ old('symptoms') }}"
                    required>
            </div>

            {{-- ¿Alguna persona que desea inscribir? --}}
            <div class="mb-3">
                <label for="inputSymptoms" class="form-label">¿Alguna persona que desea inscribir? </label>
                <input type="text" class="form-control" id="inputSymptoms" name="symptoms" value="{{ old('symptoms') }}"
                    required>
            </div>




            <button type="submit" class="btn btn-primary">Registrarme</button>

        </form>

    </section>

@endsection
