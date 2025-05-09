<header class="navbar navbar-expand-lg" style="background-color: #999898;">
    <div class="container-fluid" style="max-width: 90%;">
        <a href="/" class="d-flex align-items-center text-light text-decoration-none me-3">
            <img src="{{ asset('images/logo-tms-black.png') }}" alt="Logo" style="width: 50px;" class="img-fluid me-2">
            <span class="fs-4 text-nowrap">TMS</span>
        </a>

        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center justify-content-md-between" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('anotacoes.index') }}">Anotações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('categorias.index') }}">Categorias</a>
                </li>
            </ul>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle"
                    id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end text-small shadow" aria-labelledby="dropdownUser2">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-left text-danger"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>