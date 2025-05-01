<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app" class="d-flex flex-column">
        {{-- @if(Auth::check())
        @include('layouts.header')
        @endif --}}
        <main class="d-flex flex-fill flex-column justify-content-between">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>


    <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('js/jquery.loadingModal.js') }}" defer></script>
    <script src="{{ asset('js/default.js') }}" defer></script>

</body>

</html>

<style>
    #app {
        min-height: 100vh;
    }

    main {
        flex-grow: 1;
        padding: 20px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            const errorMessage = document.getElementById('error_message');
            if (errorMessage) {
                errorMessage.classList.add('d-none');
                errorMessage.classList.remove('d-flex');
            }

            const successMessage = document.getElementById('success_message');
            if (successMessage) {
                successMessage.classList.add('d-none');
                successMessage.classList.remove('d-flex');
            }

            const warningMessage = document.getElementById('warning_message');
            if (warningMessage) {
                warningMessage.classList.add('d-none');
                warningMessage.classList.remove('d-flex');
            }
        }, 10000);
    });

</script>