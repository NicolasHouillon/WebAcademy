@extends('layouts.admin')

@section('title', "Modification du fichier " . $attachment->name)

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('admin.attachments.update', $attachment) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $attachment->name }}">
        </div>
        <div class="form-group">
            <label for="course">Cours</label>
            <select name="course" id="course" class="custom-select">
                <option value="{{ $attachment->course->id }}">{{ $attachment->course->name }}</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
