@extends('layouts.admin')

@section('title', 'Gestion des groupes')

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

    <a href="{{ route('admin.groups.create') }}" class="btn btn-primary">Ajouter</a>

    <table class="table table-striped table-bordered table-hover mt-4">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col" class="text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
            <tr>
                <th scope="row">{{ $group->id }}</th>
                <td>{{ $group->name }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.groups.edit', $group) }}" class="btn btn-primary">Modifier</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
