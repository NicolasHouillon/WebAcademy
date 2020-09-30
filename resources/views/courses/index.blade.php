@extends('layouts.app')

@section('content')
    <h1>Liste des cours</h1>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <form action="{{ route('courses.index') }}" method="get">
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

        <label for="subject">Liste des matères</label>
        <select name="subject" id="subject">
            <option value=""></option>
            @foreach($subjects as $s)
                @if(request()->subject == $s->id)
                    <option value="{{ $s->id }}" selected>{{ $s->name }}</option>
                @else
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
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
            <a href="{{ route('index') }}">Réinitialiser les filtres</a>
        </button>
    </form>

    <ul>
        @foreach($courses as $course)
            <li>
                <a href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
