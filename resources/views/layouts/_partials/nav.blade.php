<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    {{-- <a class="navbar-brand" href="#">Prueba tecnica</a> --}}
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        {{-- <a class="nav-link active" aria-current="page" href="#">Home</a> --}}
        <a class="nav-link  {{ Route::currentRouteName() === 'index' ? 'active' : '' }}" href="{{ route('index') }}">Inicio</a>
        <a class="nav-link  {{ Route::currentRouteName() === 'product.index' ? 'active' : '' }}" href="{{ route('product.index') }}">Productos</a> <a
        <a class="nav-link  {{ Route::currentRouteName() === 'category.index' ? 'active' : '' }}" href="{{ route('category.index') }}">Categorias</a>
      </div>
    </div>
  </div>
</nav>