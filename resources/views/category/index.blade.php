@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')

    <div class="container mt-4">
        <section class="d-flex align-items-center justify-content-between">
            <h1>Lista de categorias</h1>
            <a href="{{ route('category.create') }}" class="btn btn-primary">Crear categoria</a>
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
                    <th>Imagen</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            @if ($category->image)
                                <img src="data:image/jpeg;base64,{{ $category->image }}" class="img-fluid rounded" alt="Imagen" width="100px">
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $category->state ? 'bg-success' : 'bg-danger' }}">
                                {{ $category->state ? 'ACTIVO' : 'INACTIVO' }}
                            </span>
                        </td>
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
