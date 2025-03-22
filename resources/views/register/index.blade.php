@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')

    <div class="container mt-4">
        <section class="d-flex align-items-center justify-content-between">
            <h1>Lista de registros</h1>
            {{-- <a href="{{ route('product.create') }}" class="btn btn-primary">Crear producto</a> --}}
        </section>


        {{-- errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-striped table-bordered table-hover" id="tblRegistros">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha de nacimiento</th>
                    <th>Pertenece a una iglesia</th>
                    <th>Nombre de la iglesia</th>
                    <th>Condicion medica o alergia</th>
                    <th>Persona que desee inscribir</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrations as $registration)
                    <tr>
                       
                        <td>{{ $registration->nombre }}</td>
                        <td>{{ $registration->fecha_nacimiento }}</td>
                        <td>
                            <span class="badge {{ $registration->pertenece_iglesia ? 'bg-success' : 'bg-danger' }}">
                                {{ $registration->pertenece_iglesia ? 'SI' : 'NO' }}
                            </span>
                        </td>
                        <td>{{ $registration->nombre_iglesia }}</td>
                        <td>{{ $registration->padece_condicion_medica }}</td>
                        <td>{{ $registration->persona_invitada }}</td>
                        <td class="d-flex justify-content-end">
                            <a href="{{ route('register.edit', $registration->id) }}" class="btn btn-primary">Editar</a>
                            
                            <form id="form_destroy_{{$registration->id}}" style="opacity: 0" action="{{ route('register.destroy', $registration->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            
                            <button form="form_destroy_{{$registration->id}}" type="submit" class="btn btn-danger">Eliminar</button>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tblRegistros').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "scrollX": true,
                "order": [
                    [0, "asc"]
                ]

            });
        });
    </script>
@endsection