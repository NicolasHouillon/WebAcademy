@extends('layouts.admin')

@section('title', "Modification du cours " . $course->name)

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('admin.courses.update', $course) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $course->name }}">
                </div>
                <div class="col">
                    <label for="price">Prix</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $course->price }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="subject">Matière</label>
                    <select class="form-control" id="subject" name="subject_id">
                        <option selected value="{{ $course->subject->id }}">
                            {{ $course->subject->name }}
                        </option>
                        @foreach($subjects as $subject)
                            @if($subject->id !== $course->subject->id)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="level">Niveau scolaire</label>
                    <select class="form-control" id="level" name="level_id">
                        <option selected value="{{ $course->level->id }}">
                            {{ $course->level->name }}
                        </option>
                        @foreach($levels as $level)
                            @if($level->id !== $course->level->id)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control">
                {{ $course->description }}
            </textarea>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
