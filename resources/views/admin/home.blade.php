@extends('layouts.admin')

@section('title', "Bienvenue sur l'adminstration de " . env('APP_NAME'))

@section('content')

    @if($errors->any())
        @foreach($errors as $error)
            <div class="alert alert-warning" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

@endsection
