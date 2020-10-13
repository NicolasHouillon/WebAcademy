@extends('layouts.admin')

@section('title', 'Gestion des fichiers')

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
            <th scope="col">Aperçu</th>
            <th scope="col">Cours associé</th>
            <th scope="col" class="text-right">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attachments as $attachment)
            <tr>
                <th scope="row">{{ $attachment->id }}</th>
                <td class="w-25">{{ $attachment->name }}</td>
                <td class="w-25"><img class="img-fluid img-thumbnail" src="{{ asset('storage/'.$attachment->file) }}" alt=""></td>
                <td>{{ $attachment->course->name }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.attachments.show', $attachment) }}"
                       class="btn btn-secondary">Visualiser</a>
                    <a href="{{ route('admin.attachments.edit', $attachment) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('admin.attachments.destroy', $attachment) }}" method="post">
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
