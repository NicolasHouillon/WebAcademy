@extends('layouts.admin')

@section('title', "Modification de l'utilisateur " . $user->fullName())

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"
                           value="{{ $user->firstname }}">
                </div>
                <div class="col">
                    <label for="lastname">Nom</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->lastname }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
                <div class="col">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
                <div class="col">
                    <label for="level">Groupe</label>
                    <select class="form-control" id="level" name="group_id">
                        <option selected value="{{ $user->group->id }}">
                            {{ $user->group->name }}
                        </option>
                        @foreach($groups as $group)
                            @if($group->id !== $user->group->id)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endif
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

        <button type="submit" class="btn btn-primary">Valider</button>
    </form>

    <form enctype="multipart/form-data" action="{{route('admin.uploadAdmin', $user)}}" method="POST" >
        <div>
            @csrf
            {{-- l'avatar  --}}
            <label for="avatar"><strong> Choissisez un nouvel avatar :  </strong></label>
            <input type="file" name="avatar" id="avatar" >
        </div>
        <div>
            <button class="btn btn-success" type="submit" >Valider</button>
        </div>
    </form>

@endsection
