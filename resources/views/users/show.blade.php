@extends('layouts.app')

@section('content')

    @if(isset($error))
        <h1>{{ $error }}</h1>
    @else
        <div class="container">
            <div class="col-sm-4">
                <div class="card" style="width:400px">
                    <img class="card-img-top" src="image/Karlphoto.png" alt="Card image" style="width:50%">
                    <div class="card-body">
                        <h4 class="card-title">{{ $user->name }}</h4>
                        <a href="#" class="btn btn-primary">Modifier le profil</a>
                    </div>
                </div>
            </div>
            @if(Auth::user()->name == $user->name)
                <div class="col-sm-8">
                    <div class="card">
                        Message
                        <br><br><br><br><br><br><br><br><br><br><br><br><br>
                    </div>
                </div>
<<<<<<< HEAD
            @endauth
=======
            @endif
>>>>>>> 557e40afca0d785428aad077b43cd832bb2d6970
        </div>
    @endif

@endsection
