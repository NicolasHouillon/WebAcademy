@extends('layouts.app')

@section('content')

    @if($messages->isEmpty())
        Vous n'avez pas encore de message
    @else

    <ul style="margin-top: 100px">
        @foreach($messages as $message)
            <li>
                @if($message->receiver_id != Auth::id())
                    Conversation avec <a href="{{ route('user_profile', $message->receiverUser->slugFullName()) }}">{{ $message->receiverUser->fullName() }}</a>
                @else
                    Conversation avec <a href="{{ route('user_profile', $message->senderUser->slugFullName()) }}">{{ $message->senderUser->fullName() }}</a>
                @endif

                <p>
                    {{ $message->content }}
                </p>

                <p>
                    <a href="{{ route('messages.show', $message->receiver_id != Auth::id() ? $message->receiver_id : $message->sender_id)}}">
                        Voir la conversation
                    </a>
                </p>
            </li>
        @endforeach
    </ul>
    @endif



@endsection
