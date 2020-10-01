@extends('layouts.admin')

@section('title', "Création d'un niveau scolaire")

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('admin.levels.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="col">
                    <label for="place">Etablissement</label>
                    <input type="text" class="form-control" id="place" name="place">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
