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
    <form class="form" action="{{ route('courses.index', $slug) }}" method="get">
        <div class="liste-prof">
            <label for="teacher">Liste des profs</label>
            <select id="teacher" name="teacher" onchange="this.form.submit()">
                <option value="">Tous</option>
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
            <select name="level" id="level" onchange="this.form.submit()">
                <option value="">Tous</option>
                @foreach($levels as $l)
                    @if(request()->level == $l->id)
                        <option value="{{ $l->id }}" selected>{{ $l->name }}</option>
                    @else
                        <option value="{{ $l->id }}">{{ $l->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </form>
    </div>

    <section class="liste-cours">
        @foreach($courses as $course)
            <article class="prof">
                <div class="li-img">
                    <img src="{{ asset($course->user->avatar) }}" height="150px" width="150px">
                </div>
                <div class="li-content">
                    <p class="li-text">
                        <span style="font-weight: bold">PROFESSEUR : </span> {{ $course->user->fullName() }}<br>
                        <span style="font-weight: bold">COUR : </span> {{ $course->name }}<br>
                        <span style="font-weight: bold">Niveau : </span> {{ $course->level->name }}

                    </p>
                    <a class="li-link" href="{{ route('courses.show', $course->id) }}">Voir plus ...</a>
                </div>
            </article>
        @endforeach
    </section>
        @if(Auth::user()->hasGroup("Professeur"))
            <div class="ajout">
                <a class="ajoutCours" href="{{ route('courses.create') }}">Ajouter un cours<i class="fas fa-plus icon"></i></a>
            </div>
        @endif
    </div>
@endsection
