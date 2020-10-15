@extends('layouts.app')

@section('content')

    @if(isset($error))
        <h1>{{ $error }}</h1>
    @else
        <h1>Liste des profs</h1>
        @foreach($profs as $prof)
            <p>
                {{$prof->firstname." ".$prof->lastname}}
                <a href="{{route('user_profile', $prof->slugFullName())}}">Voir le profil</a>
                <a href="{{route('messages.show', $prof->id)}}">Envoyer un message</a>
            </p>
        @endforeach
    @endif
@endsection
