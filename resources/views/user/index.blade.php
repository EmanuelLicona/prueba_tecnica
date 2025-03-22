@extends('layouts.base')
@section('title', 'Register records')
@section('content')

    <div class="container mt-4">
        <section class="d-flex align-items-center justify-content-between">
            <h1>Lista de usuario registrados</h1>
            
        </section>
   

        <table class="table table-striped table-bordered table-hover" id="tblUsers">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                      
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#tblUsers').DataTable({
                
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "scrollX": true,


            });
        });
    </script>
@endsection
