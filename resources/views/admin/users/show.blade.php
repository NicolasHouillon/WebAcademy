@extends('layouts.admin')

@section('title', "Affichage de " . $user->fullName())

@section('content')
    <h6 class="text-muted mb-4">
        Crée le {{ $user->created_at }} et mis à jour le {{ $user->updated_at }}
    </h6>

    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Groupe</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->group->name }}</td>
        </tr>
        </tbody>
    </table>

    <img src="{{ asset($user->avatar) }}" alt="" class="img-thumbnail w-25 mt-2 mb-2">

@endsection
