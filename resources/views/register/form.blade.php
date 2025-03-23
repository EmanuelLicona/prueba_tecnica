@extends('layouts.form')

@section('title', 'Register records')
@section('content')
    <section class="flex flex-col justify-between align-items-center">

        <form class="row mx-auto border bg-white rounded" style="max-width: 800px; margin-top: 50px; padding: 20px;"
            method="POST" action="{{ route('register.store') }}">

            @csrf
            <img src="{{ asset('images/logo-iglesia.webp') }}" alt="logo iglesia" class="img-fluid mx-auto"
                style="max-width: 400px;">

            <h3 class="text-center mt-5">Registration Form</h3>


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
                <label for="inputNombre" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="inputNombre" name="nombre" value="{{ old('nombre') }}"
                    required>
            </div>

            <div class="col-md-6 mt-3">
                <label for="inputNacimiento" class="form-label">Birthday <span class="text-danger">*</span>
                </label>
                <input type="date" class="form-control" id="inputNacimiento" name="fecha_nacimiento"
                    value="{{ old('fecha_nacimiento') }}" required>
            </div>


            <div class="col-md-6 mt-3">
                <label for="inputTelefono" class="form-label">Phone <span class="text-danger">*</span>
                </label>
                <input type="tel" class="form-control" id="inputTelefono" name="telefono" value="{{ old('telefono') }}"
                    required>
            </div>


            <div class="col-md-6 mt-3">
                <label for="inputEmail" class="form-label">Email
                </label>
                <input type="email" class="form-control" id="inputEmail" name="correo" value="{{ old('correo') }}">
            </div>


            <div class="col-md-4 mt-3">
                <label for="inputPerteneceIglesia" class="form-label">Belongs to a church? <span
                        class="text-danger">*</span></label>
                <select class="form-control" id="inputPerteneceIglesia" name="pertenece_iglesia">
                    <option value="0" @if (old('pertenece_iglesia') == 0) selected @endif>NO</option>
                    <option value="1" @if (old('pertenece_iglesia') == 1) selected @endif>YES</option>
                </select>
            </div>

            <div class="col-md-8 mt-3">
                <label for="inputNombreIglesia" style="display: none;" id="labelNombreIglesia" class="form-label">Church
                    name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="inputNombreIglesia" name="nombre_iglesia"
                    style="display: none;" value="{{ old('nombre_iglesia') }}">
            </div>

            <div class="col-md-12 mt-3">
                <label for="inputPadeceCondicionMedica" class="form-label">Do you suffer from any illness or
                    allergy??</label>
                <textarea class="form-control" id="inputPadeceCondicionMedica" name="padece_condicion_medica"
                    value="{{ old('padece_condicion_medica') }}"></textarea>
            </div>


{{-- 
            <div class="col-md-12 mt-3">
                <label for="persona_invitada" class="form-label">Person who wishes to register? </label>
      

                <select class="form-control" id="persona_invitada" name="persona_invitada">
                    <option value="0" @if (old('persona_invitada') == 0) selected @endif>NO</option>
                    <option value="1" @if (old('persona_invitada') == 1) selected @endif>YES</option>
                </select>
            </div> --}}



            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Register</button>
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

            $('#persona_invitada').on('change', function() {
                if ($(this).val() == '1') {
                    $('#containerPersonaInvitada').show();
                } else {
                    $('#containerPersonaInvitada').hide();
                }
            });

        });
    </script>
@endsection
