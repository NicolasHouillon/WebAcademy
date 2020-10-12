@extends('layouts.admin')

@section('title', 'Gestion des utilisateurs')

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

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Ajouter</a>

    <table class="table table-striped table-bordered table-hover mt-4">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Groupe</th>
            <th scope="col" class="text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->group->name }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-secondary">Visualiser</a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="post">
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
