@extends('layouts.admin')

@section('title', "Modification du groupe " . $group->name)

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('admin.groups.update', $group) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $group->name }}">
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
