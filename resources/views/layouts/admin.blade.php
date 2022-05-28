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
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <style>
        body {
            background: linear-gradient(125deg, rgba(2, 0, 36, 1) 0%, rgba(9, 120, 121, 1) 53%, rgb(8, 87, 17) 100%);
            background-size: 400% 400%;
            background-repeat: no-repeat;
            animation: gradient 10s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

    </style>
</head>

<body>
    <x-navbar />
    <div class="dropdown text-center my-3">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
            data-bs-toggle="dropdown" aria-expanded="false">
            More
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            @if (Route::currentRouteName() != 'admin.posts.index')
            <li><a class="dropdown-item" href="{{ route('admin.posts.index') }}">Posts List</a></li>
            @endif
            @if (Route::currentRouteName() != 'admin.posts.create')
            <li><a class="dropdown-item" href="{{ route('admin.posts.create') }}">Add new post</a></li>
            @endif
            <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Categories</a></li>
            <li><a class="dropdown-item" href="#">New category</a></li>
        </ul>
    </div>
    @yield('pageMain')
</body>

</html>
