@extends('layouts.base')
@section('title', 'Prueba tecnica')
@section('content')

    <div class="container mt-4 mx-auto">
        <h1>Editar Producto</h1>
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

            <form class="col-md-9" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" required
                        value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description"
                        value="{{ $product->description }}">
                </div>

                {{-- categorias --}}
                <div class="form-group">
                    <label for="categories">Categorias</label>
                    <select class="form-control" id="categories" name="categories[]" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
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
                    <a href="{{ route('product.index') }}" class="btn btn-secondary mt-3">Cancelar</a>

                    <button type="submit" class="btn btn-primary mt-3">Editar</button>
                </div>
            </form>

            <div class="col-md-3 {{ $product->image ? '' : 'd-none' }}" id="image-container">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Imagen</h5>
                        <p class="card-text">
                            <img src="{{ $product->image ? 'data:image/jpeg;base64,' . $product->image : 'https://placehold.co/150' }}"
                                id="image" class="img-fluid rounded" alt="Imagen">
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
            $('#categories').select2();

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
