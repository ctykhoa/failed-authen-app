<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>


    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body class="text-center">
<main class="form-signin w-75 m-auto">

    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link {{ Request::path() == 'home' ? 'active' : '' }}" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() == 'features' ? 'active' : '' }}" href="/features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() == 'pricing' ? 'active' : '' }}" href="/pricing">Pricing</a>
                </li>
            </ul>
        </div>

        @if(Session::get('username'))
            {{ 'Logged as: '.Session::get('username') }}
            <a href="/logout" class="btn btn-link">Log out</a>
        @else
            <a href="/login" class="btn btn-link">Log in</a>
        @endif
    </nav>

    <div class="w-100 text-end my-2 py-2">
        @if(isset($message))
            {{ $message }}
        @endif
    </div>

    @yield('content')



</main>
</body>
</html>
