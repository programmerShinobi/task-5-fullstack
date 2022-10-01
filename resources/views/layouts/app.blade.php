<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>shinobiArticles</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    shinobiArticles
                </a>
                <!-- Right Side Of Navbar -->
                <div class="ms-auto">
                    <!-- Authentication Links -->
                    @guest
                    <div class="nav-item dropdown">
                        @if (Route::has('login'))
                            <a type="button" class="btn btn-outline-primary" href="{{ route('login') }}"><em class="fa-solid fa-right-to-bracket"></em> {{ __('Login') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a type="button" class="btn btn-outline-success" href="{{ route('register') }}"><em class="fa-solid fa-user-tag"></em> {{ __('Register') }}</a>
                        @endif
                    </div>
                    @else
                        <div class="nav-item dropdown">
                            <button id="navbarDropdown" class="btn btn-outline-dark dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <em class="fa-solid fa-user-tie"></em> {{ Auth::user()->name }}
                            </button>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalLogout">
                                    <em class="fa-solid fa-right-from-bracket"></em> Logout
                                </a>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Modal Logout-->
    <div class="modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ready to Leave?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Select "Logout" below if you are ready to end your current session.
            </div>
            <div class="modal-footer">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><em class="fa-solid fa-rectangle-xmark"></em> Cancel</button>
                <a type="button" class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"><em class="fa-solid fa-right-from-bracket"></em> {{ __('Logout') }}</a>
            </div>
            </div>
        </div>
    </div>

    <!-- jQuery For DataTables Load Internet-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- DataTables : DataTables Load File-->
    {{-- <script src="{{ asset('js/core.js') }}" ></script> --}}
    <script src="{{ asset('js/chart.js') }}" ></script>

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>

