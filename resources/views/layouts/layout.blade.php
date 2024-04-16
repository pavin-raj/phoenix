<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- CSRF TOKEN --}}
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <title>Phoenix</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/multiselect-dropdown.js'])
</head>

<body>


    <x-flash-message />

    <header class="header">
        <a href="/" class="logo">
            @include('layouts.logo')
        </a>
        <nav class="grid">
            @auth

                <a href="/alerts/index" class="grid-item">Alerts</a>

                {{-- For all users except citizen --}}
                @unless (auth()->user()->role_id == 5)
                    <a href="/users" class="grid-item">Add Users</a>
                    <a href="/tasks/index" class="grid-item">Tasks</a>
                @endunless

                @can('isCitizen')
                    <a href="/tasks/index" class="grid-item">Open Requests</a>
                @endcan

                <form action="{{ route('logout') }}" method="post" class="grid-item">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-link">Logout</button>
                </form>
                <a href="/users/show/{{ Auth::user()->id }}" class="grid-item">Profile</a>
                <a class="btn bg-primary grid-item" href="/tasks">Report Danger</a>
            @else
                <a href="/alerts/index" class="grid-item">Alerts</a>
                <a href="/tasks/index" class="grid-item">Open Requests</a>
                <div href="/users" class="grid-item relative dropdown-toggle">Register
                    <ul class="absolute hidden top-12 left-6 p-3 shadow-lg rounded-xl dropdown-menu">
                        <li class="m-3"><a href="/users" >Citizen Registration</a></li>
                        <li class="m-3"><a href="/users/volunteer">Volunteer Registration</a></li>
                </div>
                </ul>
                <a href="/login" class="grid-item">Login</a>
                <a class="btn bg-primary grid-item" href="/tasks">Report Danger</a>

            @endauth
        </nav>
    </header>



    @yield('content')

    @include('layouts.footer')
</body>

</html>
