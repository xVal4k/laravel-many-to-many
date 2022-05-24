<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }} - @yield('pageTitle')</title>

    {{-- Css link --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Script link --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    @yield('pageMain')
</body>
</html>
