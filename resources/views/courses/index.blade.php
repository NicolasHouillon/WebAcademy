@extends('layouts.app')

<head>
    <link rel="stylesheet" href="{{ asset('css/courses.css') }}">
</head>

@section('content')
    <div class="course">

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="filtre">
    <form action="{{ route('courses.index', $slug) }}" method="get">
        <div class="liste-prof">
            <label for="teacher">Liste des profs</label>
            <select id="teacher" name="teacher">
                <option value=""></option>
                @foreach($teachers as $t)
                    @if(request()->teacher == $t->id)
                        <option value="{{ $t->id }}" selected>{{ $t->fullName() }}</option>
                    @else
                        <option value="{{ $t->id }}">{{ $t->fullName() }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="liste-niveau">
            <label for="level">Niveaux scolaires</label>
            <select name="level" id="level">
                <option value=""></option>
                @foreach($levels as $l)
                    @if(request()->level == $l->id)
                        <option value="{{ $l->id }}" selected>{{ $l->name }}</option>
                    @else
                        <option value="{{ $l->id }}">{{ $l->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
            <button class="bouton-filtrer" type="submit">Filtrer</button>
            <button class="bouton-reinitialiser"><a href="{{ route('courses.index', $slug) }}">Réinitialiser</a></button>
    </form>
    </div>

    <ul class="professeur">
        @foreach($courses as $course)
            <li>
                <span class="image">
                    <img src="{{ asset($course->user->avatar) }}" height="100px" width="100px">
                </span>
                <a href="{{ route('courses.show', $course->id) }}">
                    PROFESSEUR : {{ $course->user->fullName() }}<br>
                    COURS : {{ $course->name }}
                </a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
