@extends('layouts.auth')

@section('title', 'Prueba tecnica')
@section('content')
    <section class="flex flex-col justify-between align-items-center ">

        <form class="row mx-auto border" style="max-width: 800px; margin-top: 50px; padding: 20px;" method="POST" action="{{ route('register.store') }}">

            @csrf

            <h1 class="text-center">Formulario de registro</h1>

            @if (session('success'))
                <div class="alert alert-success d-flex flex-col justify-content-between align-items-center" role="alert">
                    <span>
                        {{ session('success') }}
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                
            @endif

            <div class="col-md-6 mt-3">
                <label for="inputNombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="inputNombre" name="nombre" value="{{ old('nombre') }}"
                    required>
            </div>

            <div class="col-md-6 mt-3">
                <label for="inputNacimiento" class="form-label">Fecha de nacimiento <span class="text-danger">*</span>
                </label>
                <input type="date" class="form-control" id="inputNacimiento" name="fecha_nacimiento"
                    value="{{ old('fecha_nacimiento') }}" required>
            </div>

            <div class="col-md-4 mt-3">
                <label for="inputPerteneceIglesia" class="form-label">¿Pertenece a una iglesia? <span
                        class="text-danger">*</span></label>
                <select class="form-control" id="inputPerteneceIglesia" name="pertenece_iglesia">
                    <option value="0" @if (old('pertenece_iglesia') == 0) selected @endif>No</option>
                    <option value="1" @if (old('pertenece_iglesia') == 1) selected @endif>Si</option>
                </select>
            </div>

            <div class="col-md-8 mt-3">
                <label for="inputNombreIglesia" style="display: none;" id="labelNombreIglesia" class="form-label">Nombre de
                    la iglesia <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="inputNombreIglesia" name="nombre_iglesia"
                    style="display: none;" value="{{ old('nombre_iglesia') }}" >
            </div>

            <div class="col-md-12 mt-3">
                <label for="inputPadeceCondicionMedica" class="form-label">¿Padece alguna condicion medica o
                    alergia?</label>
                <textarea class="form-control" id="inputPadeceCondicionMedica" name="padece_condicion_medica"
                    value="{{ old('padece_condicion_medica') }}"></textarea>
            </div>



            <div class="col-md-12 mt-3">
                <label for="inputSymptoms" class="form-label">¿Persona que desee inscribir? </label>
                <input type="text" class="form-control" id="inputSymptoms" name="symptoms" value="{{ old('symptoms') }}">
            </div>


            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Registrarme</button>
            </div>


        </form>

    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#inputPerteneceIglesia').on('change', function() {
                if ($(this).val() == '1') {
                    $('#inputNombreIglesia').show();
                    $('#labelNombreIglesia').show();

                    $('#inputNombreIglesia').prop('required', true);
                } else {
                    $('#inputNombreIglesia').hide();
                    $('#labelNombreIglesia').hide();
                    $('#inputNombreIglesia').prop('required', false);
                }
            });

        });
    </script>
@endsection