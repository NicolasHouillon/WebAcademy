@extends('layouts.admin')

@section('title', "Affichage du fichier " . $attachment->name)

@section('content')
    <h6 class="text-muted mb-4">
        Crée le {{ $attachment->created_at }} et mis à jour le {{ $attachment->updated_at }}
    </h6>

    <p>
        Ce fichier est associé au cours <a href="{{ route('admin.courses.show', $attachment->course) }}">{{ $attachment->course->name }}</a>.
    </p>

    <img class="img-fluid img-thumbnail" src="{{ asset('storage/'.$attachment->file) }}" alt="">

@endsection
