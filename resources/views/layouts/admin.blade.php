<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Boolfolio') }}</title>

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">Laravel Boolfolio</a>

            <!-- sostituito la searchbar -->
            <ul class="navbar-nav ml-auto pe-4">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('admin') }}">{{__('Dashboard')}}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class=" pt-3 sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{Route::currentRouteName() === 'admin.dashboard' ? 'active' : ''}}" aria-current="page" href="{{route('admin.dashboard')}}">
                                    <span data-feather="home" class="align-text-bottom"></span>
                                    <i class="fa-solid fa-clipboard-list"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Route::currentRouteName() === 'admin.projects.index' ? 'active' : ''}}" href="{{route('admin.projects.index')}}">
                                    <span data-feather="file" class="align-text-bottom"></span>
                                    <i class="fa-solid fa-pencil"></i>
                                    Projects
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Route::currentRouteName() === 'admin.types.index' ? 'active' : ''}}" href="{{route('admin.types.index')}}">
                                    <span data-feather="file" class="align-text-bottom"></span>
                                    <i class="fa-solid fa-folder-tree"></i>
                                    Types
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Route::currentRouteName() === 'admin.technologies.index' ? 'active' : ''}}" href="{{route('admin.technologies.index')}}">
                                    <span data-feather="file" class="align-text-bottom"></span>
                                    <i class="fa-solid fa-code"></i>
                                    Technologies
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>

</html>