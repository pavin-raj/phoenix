<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-grey-light">

    <div class="error-section">
        <div class="banner-wrapper">
            <h1 class="banner-heading">Some error happened @yield('code')</h1>
            <a class="btn bg-primary" href="/">Back to home</a>
        </div>
    </div>
</body>

</html>
