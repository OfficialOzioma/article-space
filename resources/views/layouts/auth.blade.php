<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 border-bottom fixed-top bg-white">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark" style="text-decoration: none;">
                <span class="text-capitalize">
                    <h1>Article Space</h1>
                </span>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 " style=" margin-right: 4%">
                <li><a href="/home" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="{{ route('trending') }}" class="nav-link px-2 link-dark">Trending</a></li>
                <li><a href="{{ route('featured') }}" class="nav-link px-2 link-dark">Featured</a></li>
            </ul>

            <div class="col-md-3 text-end align-content-center mr-5">

                <a href="/login" class=" text-white">
                    <button type="button" class="btn btn-outline-primary me-2">Login</button>
                </a>

                <a href="/register" class=" text-white text-decoration-none">
                    <button type="button" class="btn btn-primary"> Sign-up </button>
                </a>

            </div>
        </header>
    </div>

    <div class="main">
        @yield('content')
    </div>

    <!-- JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
