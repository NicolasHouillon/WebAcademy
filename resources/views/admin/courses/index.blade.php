@extends('layouts.admin')

@section('title', 'Gestion des cours')

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

    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prix</th>
            <th scope="col">Auteur</th>
            <th scope="col">Matière</th>
            <th scope="col">Niveau</th>
            <th scope="col">Validé</th>
            <th scope="col" class="text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <th scope="row">{{ $course->id }}</th>
                <td>{{ $course->name }}</td>
                <td>{{ $course->price }}€</td>
                <td>{{ $course->user->fullName() }}</td>
                <td>{{ $course->subject->name }}</td>
                <td>{{ $course->level->name }}</td>
                <td>{{ $course->valide ? '👍' : '❌' }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-secondary">Visualiser</a>
                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('admin.courses.destroy', $course) }}" method="post">
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
