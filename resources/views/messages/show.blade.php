@extends('layouts.app')

@section('content')

    <ul style="margin-top: 100px">
        @foreach($messages as $message)
            <li style="margin-bottom: 10px">
                <b>{{ $message->senderUser->fullName() }}</b> :  {{$message->content}}
            </li>
        @endforeach
    </ul>

    <form method="post" action="{{ route('message.store', $user) }}">
        @csrf
        @method('POST')

        @error('content')
        {{ $message }}
        @enderror
        Contenu du message pour {{ $user->fullName() }}
        <br>
        <textarea name="contenu" id="contenu" cols="100" rows="20"></textarea>

        <button type="submit">Envoyer</button>
    </form>
    <a href="{{route('messages')}}">Retour</a>




@endsection
