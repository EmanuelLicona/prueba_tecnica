@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')

    <div class="container">
        <section class="d-flex align-items-center justify-content-between">
            <h1>Categorias</h1>
            <a href="{{ route('category.create') }}" class="btn btn-primary">Crear</a>
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
        
        <table class="table table-striped table-bordered table-hover" id="tblCategories">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->state ? 'Activo' : 'Inactivo' }}</td>
                        <td>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">Editar</a>
                            <a href="{{ route('category.destroy', $category->id) }}" class="btn btn-danger">Eliminar</a>
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
            $('#tblCategories').DataTable({
                "language": {
                    // "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                    // uno por uno 
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
                "order": [
                    [0, "asc"]
                ]
                
            });
        });
    </script>
@endsection
