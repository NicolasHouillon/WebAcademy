@extends('layouts.admin')

@section('title', "Création d'un utilisateur")

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('admin.users.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control" id="firstname" name="firstname">
                </div>
                <div class="col">
                    <label for="lastname">Nom</label>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="col">
                    <label for="level">Groupe</label>
                    <select class="form-control" id="level" name="group_id">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="col">
                    <label for="password_repeat">Répétition du mot de passe</label>
                    <input type="password" class="form-control" id="password_repeat" name="password_repeat">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <label class="custom-file-label" for="avatar">Avatar</label>
                <input type="file" id="avatar" name="avatar" class="custom-file-input">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

@endsection
