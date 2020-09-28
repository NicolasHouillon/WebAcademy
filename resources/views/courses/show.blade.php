@extends('layouts.app')

@section('content')
    @if(isset($error))
        <h1>{{ $error }}</h1>
    @else
        <h1>
            Le cours {{ $course->name }} publié par {{ $course->user->fullName() }}

            <p>
                <a href="{{ route('courses.edit', $course) }}">Modifier</a>
            </p>
        </h1>
    @endif
@endsection
