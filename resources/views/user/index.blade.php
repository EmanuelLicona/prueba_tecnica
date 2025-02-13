@extends('layouts.base')
@section('title', 'Prueba tecnica')
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
                "language": {
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "No hay registros que mostrar",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "infoPostFix": "",
                    "loadingRecords": "Cargando...",
                    "zeroRecords": "No se encontraron registros",
                    "emptyTable": "No hay datos disponibles en esta tabla",
                    "paginate": {
                        "first": "Primero",
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "last": "Último"
                    },
                },
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
