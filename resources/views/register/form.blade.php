@extends('layouts.form')

@section('title', 'Register records')
@section('content')
    <section class="flex flex-col justify-between align-items-center">

        <form class="row mx-auto border bg-white rounded" style="max-width: 800px; margin-top: 50px; padding: 20px;"
            method="POST" action="{{ route('register.store') }}" id="formRegister">

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
                <label for="selectPadeceCondicionMedica" class="form-label">Do you suffer from any illness or
                    allergy?? <span class="text-danger">*</span></label>

                <div class="row" style="">

                    <div class="col-md-4">
                        <select class="form-control " id="selectPadeceCondicionMedica">
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>

                    </div>

                </div>
                <textarea class="form-control mt-1" id="inputPadeceCondicionMedica" name="padece_condicion_medica"
                    style="display:none;"></textarea>
            </div>


            <section class="col-md-12 mb-5">
                <div class="col-md-12 mt-3 d-flex justify-content-between">
                    <label for="persona_invitada" class="form-label">Person who wishes to register? </label>
                </div>

                <div id="containerPersonasInvitadas" class="row my-3">
                </div>

                <button class="btn btn-success" type="button" id="btnAddPerson">ADD</button>
                <button class="btn btn-danger" type="button" id="btnDeletePerson">Delete</button>

            </section>



            <div class="col-md-12 mt-3 ">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>


        </form>

    </section>
@endsection

@section('scripts')
    <script>
        let indexPersonasInvitadas = 1;

        $(document).ready(function() {

            $("#inputTelefono").inputmask("phone", {
                "mask": "+(999) 999 9999"
            });

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

            $('#selectPadeceCondicionMedica').on('change', function() {
                if ($(this).val() == '1') {
                    $('#inputPadeceCondicionMedica').show();
                    $('#inputPadeceCondicionMedica').prop('required', true);
                } else {
                    $('#inputPadeceCondicionMedica').hide();
                    $('#inputPadeceCondicionMedica').prop('required', false);
                }
            });

            $('#btnAddPerson').on('click', function() {
                let html = "";

                html += `
                    <div class="row ${indexPersonasInvitadas >= 1 ? 'mt-4' : ''}" id="form_invited_${indexPersonasInvitadas}">
                        <h3>Person ${indexPersonasInvitadas}</h3>
                            <div class="col-md-6">
                                <label for="inputNombre_${indexPersonasInvitadas}" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inputNombre_${indexPersonasInvitadas}" name="nombre_${indexPersonasInvitadas}"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label for="inputNacimiento_${indexPersonasInvitadas}" class="form-label">Birthday <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" id="inputNacimiento_${indexPersonasInvitadas}" name="fecha_nacimiento_${indexPersonasInvitadas}"
                                required>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label for="inputPadeceCondicionMedica_${indexPersonasInvitadas}" class="form-label">Do you suffer from any illness or
                                    allergy??</label>
                                <textarea class="form-control" id="inputPadeceCondicionMedica_${indexPersonasInvitadas}" name="padece_condicion_medica_${indexPersonasInvitadas}"a></textarea>
                            </div>
                        </div>

                    `;

                $('#containerPersonasInvitadas').append(html);
                indexPersonasInvitadas++;
            });

            $('#btnDeletePerson').on('click', function() {
                $('#form_invited_' + indexPersonasInvitadas).remove();

                if (indexPersonasInvitadas == 1) return;
                indexPersonasInvitadas--;
            });

            $('#formRegister').on('submit', function(e) {
                e.preventDefault();

                const nombre = $('#inputNombre').val();
                const email = $('#inputEmail').val();
                const telefono = $('#inputTelefono').val();

                let verify = Inputmask.isValid(telefono, {
                    mask: "+(999) 999 9999"
                });

                if (!verify) {
                    toastr.error('Telefono no es valido ' + telefono);
                    $('#inputTelefono').focus();
                    return;
                }

                const fecha_nacimiento = $('#inputNacimiento').val();
                const pertenece_iglesia = $('#inputPerteneceIglesia').val();
                const nombre_iglesia = $('#inputNombreIglesia').val();
                const padece_condicion_medica = $('#inputPadeceCondicionMedica').val();

                const personaInvitadas = [];
                for (let i = 0; i < indexPersonasInvitadas; i++) {
                    personaInvitadas.push({
                        nombre: $(`#inputNombre_${i}`).val(),
                        fecha_nacimiento: $(`#inputNacimiento_${i}`).val(),
                        padece_condicion_medica: $(`#inputPadeceCondicionMedica_${i}`).val(),
                    });
                }

                const data = {
                    nombre,
                    email,
                    telefono,
                    fecha_nacimiento,
                    pertenece_iglesia,
                    nombre_iglesia,
                    padece_condicion_medica,
                    personas_invitadas: personaInvitadas
                };

                $.ajax({
                    url: '{{ route('register.newRegistration') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        toastr.success('Registro exitoso');
                        cleanInputs();
                    },
                    error: function(error) {
                        toastr.error('Error al registrar', error.responseJSON.error);
                    },
                });
            });

        });

        function cleanInputs() {
            $('#inputNombre').val('');
            $('#inputEmail').val('');
            $('#inputTelefono').val('');
            $('#inputNacimiento').val('');
            
            $('#inputPerteneceIglesia').val('0');

            $('#inputNombreIglesia').val('');
            $('#inputPadeceCondicionMedica').val('');

            $('#selectPadeceCondicionMedica').val('0');

            $('#containerPersonasInvitadas').html('');
            indexPersonasInvitadas = 1;

        }
    </script>
@endsection
