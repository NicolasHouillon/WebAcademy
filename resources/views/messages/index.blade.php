@extends('layouts.app')

@section('content')

    <ul style="margin-top: 100px">
{{--        {{dd($messages)}}--}}
        @foreach($messages as $message)
            <li>
                @if($message[0]->receiver_id!=Auth::id())
                    Message avec {{\App\Models\User::find($message[0]->receiver_id)->firstname}} {{\App\Models\User::find($message[0]->receiver_id)->lastname}}</a>
                @else
                    Message avec {{\App\Models\User::find($message[0]->sender_id)->firstname}} {{\App\Models\User::find($message[0]->sender_id)->lastname}}</a>
                @endif
                <br>
                {{$message[0]->content}}
                <br>
                @if($message[0]->receiver_id!=Auth::id())
                    <a href="{{route('messages.show', $message[0]->receiver_id)}}">Voir la conversation</a>
                @else
                    <a href="{{route('messages.show', $message[0]->sender_id)}}">Voir la conversation</a>
                @endif
            </li>

        @endforeach
    </ul>



@endsection
