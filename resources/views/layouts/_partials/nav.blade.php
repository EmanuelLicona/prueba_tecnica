<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        {{-- <a class="navbar-brand" href="#">Prueba tecnica</a> --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">

                <a class="nav-link  {{ Route::currentRouteName() === 'index' ? 'active' : '' }}"
                    href="{{ route('index') }}">Home</a>

                <a class="nav-link  {{ Route::currentRouteName() === 'user.index' ? 'active' : '' }}"
                    href="{{ route('register.index') }}">Records</a>


                <a class="nav-link  {{ Route::currentRouteName() === 'user.index' ? 'active' : '' }}"
                    href="{{ route('user.index') }}">Users</a>



                @if (Auth::check())
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                @endif
            </div>
        </div>
    </div>
</nav>
