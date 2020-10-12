@extends('layouts.app')

@section('content')

    <ul style="margin-top: 100px">
        @foreach($messages as $message)
            <li>
                {{$message->content}}
            </li>

        @endforeach
    </ul>

    @if($message->receiver_id!=Auth::id())
        <a href="{{route('message.create', $message->receiver_id)}}">Envoyer un message</a>
    @else
        <a href="{{route('message.create', $message->sender_id)}}">Envoyer un message</a>
    @endif

    <a href="{{route('messages')}}">Retour</a>




@endsection
