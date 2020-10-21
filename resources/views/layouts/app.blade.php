 <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:https="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">

    <div class="navbar">
        <!-- Left Side Of Navbar -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{asset("/image/logo-white.png")}}" width="68" height="51">
            </a>
            <!-- Right Side Of Navbar -->
            <button class="menu" id="menuO">menu</button>
            <button class="menu" id="menuF">menu</button>
            <ul class="navbar-nav ml-auto" id="linkboutons">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item boutonHead">
                        <button class="nav-link linkLogin appButton" id="linkLogin"
                                onclick="document.getElementById('id01').style.display='block'" style="width:auto;border:none">
                            Se connecter
                        </button>
                    </li>
                    <div id="id01" class="modal">

                        <form class="modal-content animate" action="{{ route('login') }}" method="post" autocomplete="on">
                            @csrf
                            <div class="imgcontainer">
                                <h1>Se connecter</h1>
                                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                                      title="Close Modal">&times;</span>
                            </div>

                            <div class="container-login">
                                <label for="email"><b>{{ __('E-Mail Address') }}</b></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                </span>
                                @enderror

                                <label for="password"><b>{{ __('Password') }}</b></label>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <button class="button-submit appButton" type="submit" style="background-color: gainsboro">Login</button>
                                <label>
                                    <input type="checkbox" checked="checked" name="remember"> Remember me
                                </label>
                            </div>

                            <div class="container-login">
                                <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                        class="cancelbtn appButton" style="background-color: gainsboro">Cancel
                                </button>
                                <span class="psw">Forgot <a href="#">password?</a></span>
                            </div>
                        </form>
                    </div>
                    @if (Route::has('register'))
                        <li class="nav-item boutonHead">
                            <button class="nav-link linkRegister appButton" id="linkRegister"
                                    onclick="document.getElementById('id02').style.display='block'" style="width:auto;border:none">
                                S'inscrire
                            </button>
                        </li>
                        <div id="id02" class="modal">

                            <form class="modal-content animate" action="{{ route('register') }}" method="post" autocomplete="on">
                                @csrf
                                <div class="imgcontainer">
                                    <h1>REGISTER</h1>
                                    <span onclick="document.getElementById('id02').style.display='none'" class="close"
                                          title="Close Modal">&times;</span>
                                </div>

                                <div class="container-login">

                                    <!-- Firstname -->
                                    <label for="firstname"><b>{{ __('Firstname') }}</b></label>
                                    <input id="firstname" type="firstname"
                                           class="form-control @error('firstname') is-invalid @enderror"
                                           name="firstname" value="{{ old('firstname') }}" required
                                           autocomplete="firstname" autofocus>
                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                <!-- Lastname -->
                                    <label for="lastname"><b>{{ __('Lastname') }}</b></label>
                                    <input id="lastname" type="lastname"
                                           class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                           value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                <!-- Email -->
                                    <label for="email"><b>{{ __('E-Mail Address') }}</b></label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror

                                <!-- PSWD -->
                                    <label for="password"><b>{{ __('Password') }}</b></label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <label for="password-confirm"
                                           class="col-md-4 col-form-label text-md-right"><b>{{ __('Confirm Password') }}</b></label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                    <!-- PROF/ETUDIANT -->
                                    <div class="radio" style="display: flex;margin: 1em">
                                        <div style="margin-right: 5em">
                                            <input type="radio" id="group_id" name="group_id" value="4" checked>
                                            <label for="group_id">Etudiant</label><br>
                                        </div>
                                        <div>
                                            <input type="radio" id="group_id" name="group_id" value="2">
                                            <label for="group_id">Prof</label><br>
                                        </div>
                                    </div>

                                    <button class="button-submit appButton" type="submit" style="background-color: gainsboro">Register</button>
                                    <label class="remember">
                                        <input type="checkbox" checked="checked" name="remember"> Remember me
                                    </label>
                                </div>
                            </form>
                        </div>
                    @endif
                @else
                    @if(Auth::user()->hasGroup('Administrateur'))
                        <li class="nav-item">
                            <a href="{{ route('admin.home') }}" class="nav-link">Administration</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        @if(url()->full() == url('http://127.0.0.1:8000/@'.Auth::user()->slugFullName()))
                            <a id="navbarDropdown" class="nav-link"
                               href="{{ url('/') }}"> Retour menu
                            </a>
                        @else
                            <a id="navbarDropdown" class="nav-link"
                               href="{{route('user_profile', ['name' => Auth::user()->slugFullName()])}}">
                                {{ Auth::user()->fullName() }}
                            </a>
                        @endif

                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Deconnexion') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>

    <main style="position: relative;">
        @yield('content')
    </main>
    @extends('layouts.footer')

</div>
<script>
    // Get the modal
    var modal = document.getElementById('id01');
    var modal2 = document.getElementById('id02');
    var menuO = document.getElementById('menuO');
    var menuF = document.getElementById('menuF');
    var navbar = document.getElementById('linkboutons');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
        if (event.target === modal2) {
            modal2.style.display = "none";
        }

        if (event.target === menuO) {
            navbar.style.visibility='visible';
            menuO.style.visibility='hidden';
            menuF.style.visibility='visible';
        }
        if (event.target === menuF) {
            navbar.style.visibility='hidden';
            menuO.style.visibility='visible';
            menuF.style.visibility='hidden';
        }
    };
</script>
</body>
</html>

