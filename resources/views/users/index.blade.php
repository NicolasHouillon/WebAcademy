@extends('layouts.app')
<head>
    <link rel="stylesheet" href="{{ asset('css/courses.css') }}">
</head>
@section('content')

    @if(isset($error))
        <h1>{{ $error }}</h1>
    @else
    <div class="content" style="margin-top: 5%">
        <form class="form" action="{{ route('annuaire') }}" method="get">
            <div class="filtre">
                <div class="liste-prof">
                    <label for="role">Rôle</label>
                    <select id="role" name="role" onchange="this.form.submit()">
                        <option value="">Tous</option>
                        @foreach($groups as $group)
                            @if(request()->role == $group->id)
                                <option value="{{ $group->id }}" selected>{{ $group->name }}</option>
                            @else
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="liste-prof">
                    <label for="nom">Recherche</label>
                    <input id="nom" name="nom" type="text" onsubmit="this.form.submit()" placeholder="{{$old}}">
                </div>
            </div>
        </form>

        <div class="liste-user">
            <h1>Liste des utilisateurs</h1>
            <div class="tab">
                <table>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <b>{{$user->group->name}}</b>
                        </td>
                        <td>
                            {{$user->firstname." ".$user->lastname}}
                        </td>
                        <td>
                            <a href="{{route('user_profile', $user->slugFullName())}}">Voir le profil</a>
                        </td>
                        <td>
                            <a href="{{route('messages.show', $user->id)}}">Envoyer un message</a>
                        </td>
                    </tr>

                @endforeach
                </table>
            </div>
        </div>
    </div>
    @endif

@endsection
