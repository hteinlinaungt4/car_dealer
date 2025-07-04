<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('user/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/owl.css') }}">
    <style>
        .red-star {
            color: red;
        }
    </style>
</head>

<body>

    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('user.dashboard') }}">
                    {{-- <h2> <em>Tokyo</em>  Car <em>Dealer</em></h2> --}}
                    {{ __('messages.welcome') }}
                    {{-- <img width="150px" height="50px" src="{{asset('logo/logo6.jpg')}}" alt="" srcset=""> --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto ">

                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('user.dashboard') }}">  {{ __('messages.home') }}
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.carlist') }}">  {{ __('messages.cars') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">  {{ __('messages.about') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">  {{ __('messages.contact') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('car.interest') }}">  {{ __('messages.most_interest_car') }}</a></li>

                        @if (!Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-user-circle"
                                        aria-hidden="true"></i>  {{ __('messages.login') }}</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-circle"
                                        aria-hidden="true"></i> Register
                                </a>
                            </li> --}}
                        @else
                            <li class="dropdown nav-item"> <a href="#" class="nav-link" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle"
                                        aria-hidden="true"></i>
                                    {{ Auth::user()->name }}
                                    <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('userpassword#changepage') }}"> {{ __('messages.password_update') }}</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('fav') }}">{{ __('messages.favorite') }}</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('booking') }}">{{ __('messages.booking') }}</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('inquiries.index') }}">{{ __('messages.inquires') }}</a></li>
                                     <li class="nav-item"><a class="nav-link" href="{{ route('user.invoices') }}">
                                            {{ __('messages.invoices') }}</a></li>
                                    <li class="nav-item">
                                        <form class="nav-link" method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button class=" bg-transparent text-white border-0">{{ __('messages.logout') }}</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <li class="dropdown nav-item">
                            <a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-globe"></i>
                                {{ app()->getLocale() == 'en' ? 'English' : 'Myanmar' }}
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                        href="{{ route('locale.switch', ['locale' => 'en']) }}">
                                        English
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ app()->getLocale() == 'my' ? 'active' : '' }}"
                                        href="{{ route('locale.switch', ['locale' => 'my']) }}">
                                        Myanmar
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>
    </header>
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <p>Copyright © Preowned Car Selling Portal </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('user/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Additional Scripts -->
    <script src="{{ asset('user/assets/js/custom.js') }}"></script>
    <script src="{{ asset('user/assets/js/owl.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('script')
</body>

</html>
