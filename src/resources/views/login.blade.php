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
<main class="form-signin w-25 m-auto">
    <form class="mt-5" action="login" method="post">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        @isset($errorMessage)
            <div class="text text-danger">
                <span>{{ $errorMessage }}</span>
            </div>
        @endisset

        <div class="form-floating">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="email">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>

        <div class="checkbox mb-3">
            {{--            <label>--}}
            {{--                <input type="checkbox" value="remember-me"> Remember me--}}
            {{--            </label>--}}
        </div>

        @if(isset($isCaptchaRequired) && $isCaptchaRequired === true)
            {!! Captcha::img()  !!}
            <div class="form-floating my-4">
                <input name="captcha" type="text" class="form-control" id="floatingCaptcha" placeholder="Captcha">
                <label for="floatingCaptcha">Captcha</label>
            </div>
        @endif

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>


        <a href="/register" class="button">Register</a>

    </form>
</main>
</body>
</html>
