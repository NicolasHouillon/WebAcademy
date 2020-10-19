@extends('layouts.app')

@section('content')

    @if(isset($error))
        <h1>{{ $error }}</h1>
    @else

        <form class="form" action="{{ route('annuaire') }}" method="get">
            <div class="liste-prof">
                <label for="role">Rôle</label>
                <select id="role" name="role">
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
            <button class="bouton-filtrer" type="submit">Filtrer</button>
            <button class="bouton-reinitialiser"><a href="{{ route('annuaire') }}">Réinitialiser</a></button>
        </form>
        <h1>Liste des utilisateurs</h1>
        <table>
        @foreach($users as $user)
            <tr>
                <td>
                    {{$user->group->name}}
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
    @endif
@endsection
