@extends('layouts.app')
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
@section('content')
    <div class="content">
        <div class="bouton-retour">
            <a href="{{url('annuaire')}}">retour liste</a>
        </div>
        <div class="title">
            Mes messages
        </div>
    @if($messages->isEmpty())
        Vous n'avez pas encore de message
    @else

    <ul style="margin-top: 100px">
        @foreach($messages as $message)
            <div class="messages">
                <li>
                    <div class="messages-title">
                        @if($message->receiver_id != Auth::id())
                            <a href="{{ route('user_profile', $message->receiverUser->slugFullName()) }}"><b>{{ $message->receiverUser->fullName() }}</b></a>
                        @else
                            <a href="{{ route('user_profile', $message->senderUser->slugFullName()) }}">{{ $message->senderUser->fullName() }}</a>
                        @endif
                    </div>
                    <div class="messages-content">
                        <p>
                            Dernier message : {{ $message->content }}
                        </p>
                    </div>
                    <div class="messages-voirConversation">
                        <p>
                            <a href="{{ route('messages.show', $message->receiver_id != Auth::id() ? $message->receiver_id : $message->sender_id)}}">
                                Voir la conversation
                            </a>
                        </p>
                    </div>
                </li>
            </div>
        @endforeach
    </ul>
    @endif
        </div>
    </div>

@endsection
