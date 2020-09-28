@extends('layouts.app')

@section('content')
    <h1>Créer un cours</h1>

    <form method="post" action="{{ route('courses_store') }}">
        @csrf
        @method('POST')

        <table>
            <tr>
                @error('name')
                    <td>{{ $message }}</td>
                @enderror
                <td><label for="name">Nom du cours</label></td>
                <td><input type="text" name="name" id="name"></td>
            </tr>
            <tr>
                @error('description')
                    <td>{{ $message }}</td>
                @enderror
                <td><label for="description">Description du cours</label></td>
                <td><textarea name="description" id="description" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                @error('price')
                    <td>{{ $message }}</td>
                @enderror
                <td><label for="price">Prix du cours</label></td>
                <td><input type="number" name="price" id="price"></td>
            </tr>
            <tr>
                @error('subject_id')
                    <td>{{ $message }}</td>
                @enderror
                <td><label for="subject_id">Matière du cours</label></td>
                <td>
                    <select id="subject_id" name="subject_id">
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
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
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>

        <button type="submit">Créer</button>
    </form>
@endsection
