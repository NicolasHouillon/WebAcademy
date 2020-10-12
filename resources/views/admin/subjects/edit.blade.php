@extends('layouts.admin')

@section('title', "Modification de la matière " . $subject->name)

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('admin.subjects.update', $subject) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $subject->name }}">
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
