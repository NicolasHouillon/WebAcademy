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
                            <a href="{{route('edit_profile',$user->slugFullName())}}" class="btn btn-primary">Modifier
                                le profil</a>
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

                {{--        LES COURS ACHETES        --}}
                @if($user->group->name == "Etudiant")
                    @foreach($orders as $order)
                        <div class="card">
                            <div class="card-header">{{ $order["details"]->id }}</div>
                            <div class="card-deck">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $order["order"]->course->name }}</h5>
                                    <p>
                                        Paiment de {{ $order["details"]->purchase_units[0]->amount->value }}€
                                        le {{ date_format($order["order"]->course->created_at, "d/M/Y") }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if($user->group->name == "Professeur")
                    <div class="col-sm-12">
                        <div class="card">
                            Les cours qu'il a créer
                            <div class="card-body">
                                @foreach($mesCours as $cours)
                                    <p>{{$cours->name}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    @endif
@endsection
