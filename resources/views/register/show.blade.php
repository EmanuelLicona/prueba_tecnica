@extends('layouts.base')

@section('title', 'Register records')

@section('content')

    <div class="container mt-4 shadow p-4 rounded">
        <h1>Registration</h1>

        <dl>
            <dt>Name</dt>
            <dd>{{ $registration->nombre }}</dd>

            <dt>Birthday</dt>
            <dd>{{ $registration->fecha_nacimiento }}</dd>

            <dt>Phone</dt>
            <dd>{{ $registration->telefono }}</dd>

            <dt>Email</dt>
            <dd>{{ $registration->correo }}</dd>

            <dt>Belongs to a church?</dt>
            <dd>
                <span class="badge {{ $registration->pertenece_iglesia ? 'bg-success' : 'bg-danger' }}">
                    {{ $registration->pertenece_iglesia ? 'SI' : 'NO' }}
                </span>
            </dd>

            <dt>Church name</dt>
            <dd>{{ $registration->nombre_iglesia }}</dd>

            <dt>Do you suffer from any illness or allergy?</dt>
            <dd>{{ $registration->padece_condicion_medica }}</dd>

            <dt>Person who wishes to register?</dt>
            <dd class="px-4">
                <ul class="list-group">
                    @foreach ($registration->childrenRegistrations as $persona)
                        <li>
                            <span class="badge bg-primary">Persona {{ $loop->iteration }}</span>
                            <dt>{{ $persona->nombre }}</dt>
                            <dd>{{ $persona->fecha_nacimiento }}</dd>
                            <dd>{{ $persona->padece_condicion_medica }}</dd>  
                        </li>
                    @endforeach
                </ul>
            </dd>
        </dl>
        <div>
            <a href="{{ route('register.index') }}" class="btn btn-primary">Back</a>
        </div>

    </div>

@endsection

@section('scripts')
    <script></script>
@endsection
