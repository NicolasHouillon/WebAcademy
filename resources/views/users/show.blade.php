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
                        <h4 class="card-title">{{ $user->firstname }}</h4>
                        <p class="card-text">{{ $user->lastname }}</p>
                        <p class="card-text">{{ $user->email }}</p>
                        <a href="#" class="btn btn-primary">Modifier le profil</a>
                    </div>
                </div>
            </div>
            @if(Auth::user()->firstname == $user->firstname)
                <div class="col-sm-8">
                    <div class="card">
                        Message
                        <br><br><br><br><br><br><br><br><br><br><br><br><br>
                    </div>
                </div>
            @endauth
            @endif
        </div>

@endsection
