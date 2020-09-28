@extends('layouts.app')

@section('content')
    @if(isset($error))
        <h1>{{ $error }}</h1>
    @else
        <h1>
            Le cours {{ $course->name }} publié par {{ $course->user->fullName() }}
        </h1>
    @endif
@endsection
