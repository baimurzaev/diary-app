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
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
</head>
<body>

@include('icons.svg')

<header class="p-3 mb-3 border-bottom bg-light">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none"
               style="margin-right: 15px;">
                <img src="/svg/logo.svg" alt="" style="width: 40px">
                <span class="fs-4">Дневник</span>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <a href="/" class="nav-link px-2 link-dark">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#table"></use>
                        </svg>
                        Расписания</a>
                </li>
                <li><a href="/classroom" class="nav-link px-2 link-dark">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Классы</a></li>
                <li><a href="/groups" class="nav-link px-2 link-dark">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#grid"></use>
                        </svg>
                        Группы</a></li>
                <li><a href="/pupils" class="nav-link px-2 link-dark">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#people-circle"></use>
                        </svg>
                        Ученики</a></li>
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
                    <li><a class="dropdown-item" href="/profile">Профиль</a></li>
                    <li><a class="dropdown-item" href="/settings">Настройки</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="/logout">Выйти</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Page Content -->
{{ $slot }}

</body>
</html>
