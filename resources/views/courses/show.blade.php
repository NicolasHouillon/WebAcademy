@extends('layouts.app')

@section('content')
    @if($error)
        <h1>{{ $error }}</h1>
    @else
        <h1>Le cours {{ $user->name }}</h1>
    @endif
@endsection
