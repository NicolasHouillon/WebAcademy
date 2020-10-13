@extends('layouts.app')

@section('content')
    <h1>Créer un message</h1>

    <form method="post" action="{{ route('message.store',$id) }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        @error('content')
        {{ $message }}
        @enderror
        Contenu du message pour {{\App\Models\User::find($id)->firstname . \App\Models\User::find($id)->lastname}}
        <br>
        <textarea name="contenu" id="contenu" cols="100" rows="20"></textarea>

        <button type="submit">Envoyer</button>
    </form>
@endsection
