@extends('layouts.admin')

@section('title', "Affichage du cours " . $course->name)

@section('content')
    <h6 class="text-muted mb-4">
        Crée le {{ $course->created_at }} et mis à jour le {{ $course->updated_at }}
    </h6>

    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Prix</th>
            <th scope="col">Auteur</th>
            <th scope="col">Matière</th>
            <th scope="col">Niveau</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $course->price }}€</td>
            <td>{{ $course->user->fullName() }}</td>
            <td>{{ $course->subject->name }}</td>
            <td>{{ $course->level->name }}</td>
        </tr>
        </tbody>
    </table>

    <p class="mt-2 mb-2">
        {{ $course->description }}
    </p>

@endsection
