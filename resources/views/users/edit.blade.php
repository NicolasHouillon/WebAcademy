@extends("layouts.app")

@section("content")

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
        <div style="padding-top: 100px">
            <h3>Remplir les informations</h3>
            <hr class="mt-2 mb-2">
        </div>
        <div>
            {{-- le nom  --}}
            <label for="lastname"><strong> Votre nom: </strong></label>
            <input type="text" name="lastname" id="lastname"
                   value="{{ $user->lastname}}">
        </div>

        <div>
            {{-- le nom  --}}
            <label for="firstname"><strong> Votre Prénom: </strong></label>
            <input type="text" name="firstname" id="firstname"
                   value="{{ $user->firstname}}">
        </div>
        <div>
            {{-- l'email  --}}
            <label for="email"><strong> Votre email: </strong></label>
            <input type="text" name="email" id="email"
                   value="{{ $user->email}}">
        </div>
        <div>
            {{-- le mot de passe--}}
            <label for="password"><strong> Votre mot de passe: </strong></label>
            <input type="text" name="password" id="password">
        </div>
{{--        <div>--}}
{{--            --}}{{-- l'avatar  --}}
{{--            <label for="avatar"><strong> Votre avatar : </strong></label>--}}
{{--            <input type="hidden" name="MAX_FILE_SIZE" value="100000" />--}}
{{--            <input type="file" name="avatar" id="avatar"--}}
{{--                   value="{{ $user->avatar}}">--}}
{{--        </div>--}}
        <div>
            <button class="btn btn-success" type="submit">Valider</button>
            <a href="{{route('user_profile',$user->slugFullName())}}" class="button">Retour</a>
        </div>
    </form>

    <form enctype="multipart/form-data" action="{{route('upload', $user->slugFullName())}}" method="POST" >
        <div>
            @csrf
            {{-- l'avatar  --}}
            <label for="avatar"><strong> Choissisez un nouvel avatar :  </strong></label>
            <input type="file" name="avatar" id="avatar" >
        </div>
        <div>
            <button class="btn btn-success" type="submit" >Valider</button>
        </div>
    </form>
@endsection
