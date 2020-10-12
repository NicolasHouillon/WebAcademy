@extends('layouts.admin')

@section('title', "Création d'une matière ")

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('admin.subjects.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
