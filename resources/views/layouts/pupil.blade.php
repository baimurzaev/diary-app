<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/common.js')}}" defer></script>
</head>
<body>

{{--@include('icons.svg')--}}

<header class="p-3 mb-3 border-bottom bg-light">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none"
               style="margin-right: 15px;">
                <img src="/svg/logo.svg" alt="" style="width: 40px">
                <span class="fs-4">Дневник</span>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/schedule/pupil" class="nav-link px-2 link-dark">
                        <i class="bi bi-calendar3"></i> Расписание</a></li>
            </ul>

            <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                {{auth()->user()->name}} {{auth()->user()->last_name}}
            </div>

            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <img src="/images/ava.jpg" alt="mdo" class="rounded-circle" width="32" height="32">
                </a>
                <ul class="dropdown-menu text-small">
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="javascript:" onclick="$('#logout').click()">Выйти</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
<form action="/logout" method="post">
    @csrf
    <input id="logout" type="submit" style="display: none"/>
</form>

<!-- Page Content -->
{{ $slot }}

</body>
</html>
