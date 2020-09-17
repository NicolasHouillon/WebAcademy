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
                            <img src="image/logo-2 (1).png" width="68" height="51">
                        </a>
                        <!-- Right Side Of Navbar -->

                        <ul class="navbar-nav ml-auto" id="linkboutons">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <button class="nav-link linkLogin" id="linkLogin" onclick="document.getElementById('id01').style.display='block'" style="width:auto;" >Login</button>
                                </li>
                                <div id="id01" class="modal">

                                    <form class="modal-content animate" action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="imgcontainer">
                                            <h1>LOGIN</h1>
                                            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                                        </div>

                                        <div class="container-login">
                                            <label for="email" ><b>{{ __('E-Mail Address') }}</b></label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                </span>
                                @enderror

                                <label for="password"><b>{{ __('Password') }}</b></label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror

                                <button class="button-submit" type="submit">Login</button>
                                <label>
                                    <input type="checkbox" checked="checked" name="remember"> Remember me
                                </label>
                            </div>

                            <div class="container-login" style="background-color:#f1f1f1">
                                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                <span class="psw">Forgot <a href="#">password?</a></span>
                            </div>
                        </form>
                    </div>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <button class="nav-link linkRegister" id="linkRegister" onclick="document.getElementById('id02').style.display='block'" style="width:auto;" >Register</button>
                        </li>
                        <div id="id02" class="modal">

                            <form class="modal-content animate" action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="imgcontainer">
                                    <h1>REGISTER</h1>
                                    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                                </div>

                                <div class="container-login">

                                    <!-- Name -->
                                    <label for="name" ><b>{{ __('Name') }}</b></label>
                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror

                                <!-- Email -->
                                    <label for="email" ><b>{{ __('E-Mail Address') }}</b></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror

                                <!-- PSWD -->
                                    <label for="password"><b>{{ __('Password') }}</b></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror

                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><b>{{ __('Confirm Password') }}</b></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                    <button class="button-submit" type="submit">Register</button>
                                    <label>
                                        <input type="checkbox" checked="checked" name="remember"> Remember me
                                    </label>
                                </div>
                            </form>
                        </div>
                    @endif
                @else
                    <li class="nav-item">
                        <a id="navbarDropdown" class="nav-link" href="{{route('user_profile',['name'=>Auth::user()->name])}}">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
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

    <main>
        @yield('content')
    </main>
</div>
<script>
    // Get the modal
    var modal = document.getElementById('id01');
    var modal2 = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
        if (event.target === modal2) {
            modal2.style.display = "none";
        }
    };

    var linkMenu = document.getElementById('linkMenu');
    var linkLogin = document.getElementById('linkLogin');
    var linkRegister = document.getElementById('linkRegister');
    var linkboutons = document.getElementById('linkboutons');
    let flag = false;

    window.onclick = function(event) {
        if (event.target === linkMenu) {
            if(flag) {
                linkboutons.style.visibility = "hidden";
                flag = false;
            }

            if(!flag) {
                linkboutons.style.visibility = "visible";
                flag = true;
            }
        }
    }
</script>
</body>
</html>

