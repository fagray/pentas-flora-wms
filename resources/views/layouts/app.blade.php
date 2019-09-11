@inject('settings', 'App\Models\Setting')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport"
              content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token"
              content="{{ csrf_token() }}">

        <title>Pentas Flora Waste Management System</title>

        <!-- Fonts -->
        <link rel="dns-prefetch"
              href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito"
              rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.css') }}"
              rel="stylesheet">
        <link href="{{ asset('css/style.css') }}"
              rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css"
              rel="stylesheet">

    </head>

    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand"
                       href="{{ url('/') }}">

                        <img width="30"
                             src="/storage/images/{{ $settings->all()->first()->logo }}"
                             alt=""> {{ $settings->all()->first()->application_name }}

                    </a>
                    <button class="navbar-toggler"
                            type="button"
                            data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse"
                         id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        @auth
                            
                            <ul class="navbar-nav mr-auto">
                                @if (Auth::user()->role === 'administrator')
                                    <li class="nav-item">
                                        <a class="nav-link"
                                        href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                        href="{{ route('jobs') }}">{{ __('Job Orders') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                        href="{{ route('billing') }}">{{ __('Billing') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                        href="{{ route('settings') }}">{{ __('Settings') }}</a>
                                    </li>
                                @endif
                                @if (Auth::user()->role === 'driver')
                                    <li class="nav-item">
                                        <a class="nav-link"
                                           href="#">
                                            Drivers Module
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endauth

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @else
                            @if (Auth::user()->role === 'driver')
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="/">
                                        My Jobs
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->role === 'administrator')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                   class="nav-link dropdown-toggle"
                                   href="#"
                                   role="button"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false">
                                    <i class="fa fa-th-large"></i> Quick Actions
                                </a>

                                <div class="dropdown-menu dropdown-menu-right"
                                     aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                       href="{{ route('jobs.create') }}">
                                        New Job
                                    </a>
                                    {{-- <a class="dropdown-item"
                                       href="{{ route('invoices.create') }}">
                                        New Consignment Note
                                    </a> --}}

                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="/help-centre">
                                    <i class="fa fa-question-circle"> </i>
                                    Help
                                </a>
                            </li>


                            <li class="nav-item">
                                <a style="font-size:10px;text-transform:uppercase;position:relative;font-weight:500;left:115px;bottom:20px;"
                                   class="nav-link"
                                   href="#">{{ Carbon\Carbon::now()->toDayDateTimeString() }}</a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"
                                   class="nav-link dropdown-toggle"
                                   href="#"
                                   role="button"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                   v-pre>
                                    {{ Auth::user()->fname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right"
                                     aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form"
                                          action="{{ route('logout') }}"
                                          method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                @include('layouts.flash-message')
            </div>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>

</html>