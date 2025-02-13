@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')

    <div class="container mt-4 mx-auto">
        <h1>Crear Categoria</h1>
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
        <section class="row">
            <form class="col-md-9" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" required
                        value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description"
                        value="{{ old('description') }}">
                </div>

                {{-- image --}}
                <div class="form-group">
                    <label for="image">Imagen</label>
                    <input type="file" class="form-control" id="image-input" name="image">
                </div>

                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" type="checkbox" id="state" name="state" checked>
                    <label class="form-check-label" for="state">Estado</label>
                </div>
                <div>
                    <a href="{{ route('category.index') }}" class="btn btn-secondary mt-3">Cancelar</a>

                    <button type="submit" class="btn btn-primary mt-3">Crear</button>
                </div>
            </form>

            {{-- imagen --}}
            <div class="col-md-3 d-none" id="image-container">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Imagen</h5>
                        <p class="card-text">
                            <img src="https://placehold.co/150" id="image" class="img-fluid rounded" alt="Imagen">
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#image-input').change(function() {
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]);

                reader.onload = function(event) {
                    $('#image').attr('src', event.target
                        .result);
                    $('#image-container').removeClass('d-none');
                };

                reader.onerror = function() {
                    console.error('Error al cargar la imagen.');
                };
            });
        });
    </script>
@endsection
