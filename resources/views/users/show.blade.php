@extends('layouts.app')

@section('content')

    @if(isset($error))
        <h1>{{ $error }}</h1>
    @else
        <div class="container">
            <div class="col-sm-4">
                <div class="card" style="width:400px">
                    <img class="card-img-top" src="{{ $user->avatar }}" alt="Card image" style="width:50%">
                    <div class="card-body">
                        <p class="card-text">{{ $user->firstname }}</p>
                        <p class="card-text">{{ $user->lastname }}</p>
                        <p class="card-text">{{ $user->email }}</p>
                        @if(Auth::user()->firstname == $user->firstname)
                            <a href="{{route('edit_profile',$user->slugFullName())}}" class="btn btn-primary">Modifier le profil</a>
                        @endif
                    </div>
                </div>
            </div>
            @if(Auth::user()->firstname == $user->firstname)

                <div class="col-sm-8">
                    <div class="card">
                        Message
                    </div>
                </div>
            @if()
                <div class="col-sm-12">
                    <div class="card">
                        Cours Suivis
                        <div class="card-body">
                            @foreach($coursSuivis as $coursSuivi)
                                <p>{{$coursSuivi->name}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>

            @endauth
            @endif
        </div>

@endsection
