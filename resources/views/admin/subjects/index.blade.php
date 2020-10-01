@extends('layouts.admin')

@section('title', 'Gestion des matières')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if($errors->any())
        @foreach($errors as $error)
            <div class="alert alert-warning" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">Ajouter</a>

    <table class="table table-striped table-bordered table-hover mt-4">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col" class="text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <th scope="row">{{ $subject->id }}</th>
                <td>{{ $subject->name }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('admin.subjects.destroy', $subject) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
