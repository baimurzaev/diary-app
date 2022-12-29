<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/favicons/apple-touch-icon.png" sizes="192x192">
    <link rel="icon" href="/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/favicons/manifest.json">
    <link rel="mask-icon" href="/favicons/favicon.svg">
    <link rel="icon" href="/favicons/favicon.ico">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common-guest.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    {{ $slot }}
</div>
</body>
</html>
