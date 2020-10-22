@extends('layouts.app')
<head>
    <link rel="stylesheet" href="{{ asset('css/courses.css') }}">
</head>
@section('content')
    <div class="content">
        <h1 style="text-align: center">Edition du cours {{ $course->name }}</h1>

        @if(isset($error))
            <h1>{{ $error }}</h1>
        @else
            <div class="partie">
                <h2 style="margin-top: 5%">À propos du cours : </h2>
                <form method="post" action="{{ route('courses.update', $course->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <table>
                        <tr>
                            @error('name')
                                <td>{{ $message }}</td>
                            @enderror
                            <td><label for="name">Nom du cours</label></td>
                            <td><input type="text" name="name" id="name" value="{{ $course->name }}"></td>
                        </tr>
                        <tr>
                            @error('description')
                                <td>{{ $message }}</td>
                            @enderror
                            <td><label for="description">Description du cours</label></td>
                            <td><textarea name="description" id="description" cols="30" rows="10">
                                    {{ $course->description }}
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            @error('price')
                                <td>{{ $message }}</td>
                            @enderror
                            <td><label for="price">Prix du cours</label></td>
                            <td><input type="number" name="price" id="price" value="{{ $course->price }}"></td>
                        </tr>
                        <tr>
                            @error('subject_id')
                                <td>{{ $message }}</td>
                            @enderror
                            <td><label for="subject_id">Matière du cours</label></td>
                            <td>
                                <select id="subject_id" name="subject_id">
                                    @foreach($subjects as $subject)
                                        @if($course->subject->id == $subject->id)
                                                <option value="{{ $subject->id }}" selected>{{ $subject->name }}</option>
                                        @else
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            @error('level_id')
                                <td>{{ $message }}</td>
                            @enderror
                            <td><label for="level_id">Niveau scolaire du cours</label></td>
                            <td>
                                <select id="level_id" name="level_id">
                                    @foreach($levels as $level)
                                        @if($course->level->id == $level->id)
                                            <option value="{{ $level->id }}" selected>{{ $level->name }}</option>
                                        @else
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>

                    <button type="submit" style="width: 150px;">Modifier</button>
                </form>
            </div>
            <div class="ajout-fichier">
                <h3>Ajouter des fichiers : </h3>

                <form enctype="multipart/form-data" action="{{route('uploadFile', $course->id)}}" method="POST" >
                    <div>
                        @csrf
                        {{-- les fichiers  --}}
                        <input type="file" name="file[]" id="file" multiple >
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit">Valider</button>
                    </div>
                </form>
            </div>

            <div class="partie">
                <h2>Liste des Fichiers : </h2>

                <p>
                    <ul>
                        @foreach($course->attachments as $attachment)
                            <li>
                                <a href="{{asset('storage/'.$attachment->file)}}">
                                    {{$attachment->name}}
                                </a>
                                <form action="{{route('destroy_attachment', $attachment)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Supprimer</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </p>
            </div>
        @endif
    </div>
@endsection
