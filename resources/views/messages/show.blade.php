@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="message-block">
            @if($messages->isEmpty())
                Vous n'avez pas encore de message avec ce professeur
                <div class="zone-de-frappe">
                    <form method="post" action="{{ route('message.store', $user) }}">
                        @csrf
                        @method('POST')

                        @error('content')
                        {{ $message }}
                        @enderror
                        <br>
                        <textarea name="contenu" id="contenu" cols="100" rows="10"></textarea>

                        <button type="submit">Envoyer</button>
                    </form>
                    <a href="{{route('messages')}}">Retour</a>
                </div>
            @else
                <ul style="list-style: none">
                    @foreach($messages as $message)
                        <li>
                            @if($message->senderUser->fullName() == Auth::user()->fullName())
                                <div class="message-droit">
                                    <img src="{{asset($message->senderUser->avatar)}}" style="width: 2%; border-radius: 100%">
                                    <b>{{ $message->senderUser->fullName() }}</b> :  {{$message->content}}
                                </div>
                            @else
                                <div class="message-gauche">
                                    <img class="message-gauche" src="{{asset($message->senderUser->avatar)}}" style="width: 2%; border-radius: 100%">
                                    <b>{{ $message->senderUser->fullName() }}</b> :  {{$message->content}}
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
        </div>
        <div class="zone-de-frappe">
            <form method="post" action="{{ route('message.store', $user) }}">
                @csrf
                @method('POST')

                @error('content')
                {{ $message }}
                @enderror
                <br>
                <textarea name="contenu" id="contenu" required></textarea>

                <button type="submit">Envoyer</button>
            </form>
            <a href="{{route('messages')}}">Retour</a>
        </div>
        @endif
    </div>
@endsection
