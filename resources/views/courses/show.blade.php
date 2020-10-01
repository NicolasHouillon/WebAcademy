@extends('layouts.app')

@section('content')
    @if(isset($error))
        <h1>{{ $error }}</h1>
    @else
        @if($errors->any())
            <p>{{ $errors->first() }}</p>
        @endif
        <h1>
            Le cours {{ $course->name }} publié par {{ $course->user->fullName() }}

            <p>
                <a href="{{ route('courses.edit', $course) }}">Modifier</a>
                <a href="{{ route('make.payment', $course) }}">Payer {{ $course->price }}€</a>
            </p>
        </h1>
    @endif
@endsection
