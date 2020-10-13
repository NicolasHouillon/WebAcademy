@extends('layouts.app')

<head>
    <link rel="stylesheet" href="{{ asset('css/courses.css') }}">
</head>

@section('content')
    <div class="backgroung">
        <img src="../image/etudes.jpg" width="113%" height="100%">
    </div>
    <div class="page-course">
    <h1>Liste des cours</h1>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="{{ route('courses.index', $slug) }}" method="get">
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

        <label for="level">Liste des niveaux scolaires</label>
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

        <button type="submit">Filtrer</button>
        <button>
            <a href="{{ route('courses.index', $slug) }}">Réinitialiser les filtres</a>
        </button>
    </form>

    <ul class="course">
        @foreach($courses as $course)
            <a href="{{ route('courses.show', $course->id) }}">
                <li>
                    <img class="li-content" src="{{ asset($course->user->avatar) }}" height="150px" width="150px">
                    <p class="li-content">
                    PROFESSEUR : {{ $course->user->fullName() }}<br>
                    COURS : {{ $course->name }}
                    </p>
                </li>
            </a>
        @endforeach
    </ul>
    </div>
@endsection
