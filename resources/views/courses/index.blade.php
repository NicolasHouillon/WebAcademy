@extends('layouts.app')

@section('content')
    <h1>Liste des cours</h1>

    <ul>
        @foreach($courses as $course)
            <li>
                <a href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
