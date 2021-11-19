<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" />

    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

    <!-- MDB -->
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <style>
        header {
            order: 1;
        }

        .content {
            order: 2
        }

        @media screen and (max-width: 768px) {
            .header-container {
                margin-bottom: 12%;
            }
        }

        @media screen and (max-width: 500px) {
            .header-container {
                margin-bottom: 10%;
            }
        }

    </style>

    @yield('style')
</head>

<body>
    <div class="container mt-md-5 header-container">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-5 border-bottom fixed-top bg-white">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 ml-5 mb-md-0 text-dark text-decoration-none">
                <span class="text-capitalize">
                    <h2>Article Space</h2>
                </span>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0 mr-5" style=" margin-right: 4%">
                <li><a href="/home" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="{{ route('trending') }}" class="nav-link px-2 link-dark">Trending</a></li>
                <li><a href="{{ route('featured') }}" class="nav-link px-2 link-dark">Featured</a></li>
                <li>
                    <a href="{{ route('profile', auth()->user()->username) }}"
                        class="nav-link px-2 link-dark">Publish</a>
                </li>
                {{-- <li><a href="{{ route('writer') }}" class="nav-link px-2 link-dark">Writers</a></li> --}}
            </ul>
            @guest
                <div class="col-md-3 text-end align-content-center mr-5 mt-md-1 m">
                    <button type="button" class="btn btn-outline-primary me-2 mb-md-1">Login</button>
                    <button type="button" class="btn btn-primary">Sign-up</button>
                </div>
            @else
                <ul class="nav d-flex float-right ml-5 justify-content-end">
                    <!-- Example single danger button -->
                    <div class="btn-group justify-content-end ml-5">
                        <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false"> Welcome, {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout">logout</a></li>
                        </ul>
                    </div>
                </ul>

            @endguest

        </header>
    </div>
    <!--Main Navigation-->
