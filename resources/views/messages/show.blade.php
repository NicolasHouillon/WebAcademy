@extends('layouts.app')

@section('content')

    @if($messages->isEmpty())
        Vous n'avez pas encore de message avec ce professeur

    @else
    <ul style="margin-top: 100px; list-style: none">
        @foreach($messages as $message)
            <li style="margin-bottom: 10px">
                <img src="{{asset($message->senderUser->avatar)}}" style="width: 2%; border-radius: 100%">
                <b>{{ $message->senderUser->fullName() }}</b> :  {{$message->content}}
            </li>
        @endforeach
    </ul>
    @endif

    <form method="post" action="{{ route('message.store', $user) }}">
        @csrf
        @method('POST')

        @error('content')
        {{ $message }}
        @enderror
        Contenu du message pour {{ $user->fullName() }}
        <br>
        <textarea name="contenu" id="contenu" cols="100" rows="10"></textarea>

        <button type="submit">Envoyer</button>
    </form>
    <a href="{{route('messages')}}">Retour</a>

@endsection
@extends('layouts.footer')
