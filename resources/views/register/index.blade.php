@extends('layouts.base')
@section('title', 'Register records')
@section('content')

    <div class="container mt-4">
        <section class="d-flex align-items-center justify-content-between">
            <h1>List of registered records</h1>
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
                    <th>Name</th>
                    {{-- <th>Birthday</th> --}}
                    <th>Age</th>
                    {{-- <th>Phone</th> --}}
                    {{-- <th>email</th> --}}
                    {{-- <th>belongs to a church</th> --}}
                    {{-- <th>Church name</th> --}}
                    <th>Parent</th>
                    <th>Do you suffer from any illness or allergy?</th>
                    {{-- <th>person who wishes to register</th> --}}
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrations as $registration)
                    <tr>

                        <td>{{ $registration->nombre }}</td>
                        {{-- <td>{{ $registration->fecha_nacimiento }}</td> --}}
                        <td>{{ $registration->getAge() }}</td>
                        {{-- <td>{{ $registration->telefono }}</td> --}}
                        {{-- <td>{{ $registration->correo }}</td> --}}
                        {{-- <td>
                            <span class="badge {{ $registration->pertenece_iglesia ? 'bg-success' : 'bg-danger' }}">
                                {{ $registration->pertenece_iglesia ? 'SI' : 'NO' }}
                            </span>
                        </td> --}}
                        {{-- <td>{{ $registration->nombre_iglesia }}</td> --}}

                        <td>
                            @if ($registration->parentRegistration)
                                <a class="btn btn-primary" href="{{ route('register.show', $registration->parentRegistration->id) }}">
                                    GO
                                </a>
                            @endif
                        </td>

                        <td>{{ $registration->padece_condicion_medica }}</td>
                        {{-- <td>{{ $registration->persona_invitada }}</td> --}}
                        <td class="d-flex justify-content-end gap-1">
                            <a href="{{ route('register.show', $registration->id) }}" class="btn btn-primary">View</a>

                            <form id="form_destroy_{{ $registration->id }}" style="opacity: 0"
                                action="{{ route('register.destroy', $registration->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>

                            <button form="form_destroy_{{ $registration->id }}" type="submit"
                                class="btn btn-danger">Eliminar</button>
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
                "buttons": [
                    'excel', 'pdf', 'print'
                ],

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
