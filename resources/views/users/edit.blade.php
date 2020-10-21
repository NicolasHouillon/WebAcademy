@extends("layouts.app")

<head>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>

@section("content")
    <div class="edit-user">
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="titre">
            <h3>Remplir les informations</h3>
            <hr class="mt-2 mb-2" style="position: relative; width: 90%">
        </div>

        <form enctype="multipart/form-data" action="{{route('upload', $user->slugFullName())}}" method="POST" >
            <div class="avatar">
                @csrf
                {{-- l'avatar  --}}
                <div class="image">
                    <img src="{{asset($user->avatar)}}" id="img"> <br>
                </div>
                <div class="avatar-text">
                <span class="ss-text">
                    <label for="avatar"><strong> Choissisez un nouvel avatar :  </strong></label>
                    <input type="file" name="avatar" id="avatar" onchange="this.form.submit()">
                </span>
                </div>
            </div>
        </form>

    <form action="{{route('update_profile', $user->slugFullName())}}" method="POST" enctype="multipart/form-data">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><a href="#" class="alert-link"> {{ $error }}</a></strong>
                </div>
            @endforeach
        @endif

        @csrf
        @method('PUT')

        <div class="champs">
            {{-- le nom  --}}
            <label for="lastname"><strong> Votre nom: </strong></label>
            <input type="text" name="lastname" id="lastname"
                   value="{{ $user->lastname}}">
        </div>

        <div class="champs">
            {{-- le nom  --}}
            <label for="firstname"><strong> Votre Prénom: </strong></label>
            <input type="text" name="firstname" id="firstname"
                   value="{{ $user->firstname}}">
        </div>
        <div class="champs">
            {{-- l'email  --}}
            <label for="email"><strong> Votre email: </strong></label>
            <input type="text" name="email" id="email"
                   value="{{ $user->email}}">
        </div>
        <div class="champs">
            {{-- le mot de passe--}}
            <label for="password"><strong> Votre mot de passe: </strong></label>
            <input type="text" name="password" id="password">
        </div>
        <div class="boutons">
            <button class="btn btn-success" type="submit">Valider</button>
        </div>
    </form>
    <div class="boutons">
        <a class="quitter btn" href="{{route('user_profile',$user->slugFullName())}}" class="button">Retour</a>
    </div>


    </div>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('img').setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        document.getElementById('avatar').addEventListener('change', function () {
            readURL(this)
        });
    </script>

@endsection
