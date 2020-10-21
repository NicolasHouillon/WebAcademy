@extends('layouts.app')

<head>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

@section('content')
<div class="container home">
    @if(session('success'))
        <h1>{{ session('success') }}</h1>
    @endif
    <section class="tiles">
        <h1>Nous contacter</h1>

        <div>
            <form action="{{ route('sendContact') }}" method="post">
                @csrf
                @method('POST')
                <p>
                    <label for="lastname">Nom</label>
                    <input id="lastname" name="lastname" type="text">
                </p>
                <p>
                    <label for="firstname">Prénom</label>
                    <input id="firstname" name="firstname" type="text">
                </p>
                <p>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text">
                </p>
                <p>
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </p>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </section>
</div>
@endsection
