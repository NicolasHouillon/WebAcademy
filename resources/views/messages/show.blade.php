@extends('layouts.app')

@section('content')

    @if($messages->isEmpty())
        <p style="margin-top: 200px">
            Vous n'avez pas de messages avec cet utilisateur
        </p>
    @endif

    <ul style="margin-top: 100px">
        @foreach($messages as $message)
            <li style="list-style: none">
                <img src="{{asset($message->senderUser()->get()[0]->avatar)}}" style="width: 5%">
                {{$message->content}}
                <br>
                @if($message->receiver_id!=Auth::id())
                    <a href="{{route('message.delete', $message->receiver_id)}}">Supprimer le message</a>
                @else
                    <a href="{{route('message.delete', $message->sender_id)}}">Supprimer le message</a>
                @endif
            </li>

        @endforeach
    </ul>

    <a href="{{route('message.create', $id)}}">Envoyer un message</a>

    <a href="{{route('messages')}}">Retour</a>




@endsection
