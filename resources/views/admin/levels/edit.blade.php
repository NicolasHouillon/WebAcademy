@extends('layouts.admin')

@section('title', "Modification du niveau " . $level->name)

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('admin.levels.update', $level) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $level->name }}">
                </div>
                <div class="col">
                    <label for="place">Etablissement</label>
                    <input type="text" class="form-control" id="place" name="place" value="{{ $level->school_level }}">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
