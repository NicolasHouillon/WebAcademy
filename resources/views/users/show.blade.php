@extends('layouts.app')

@section('content')

    @if($error)
        <h1>{{ $error }}</h1>
    @else
        <div class="container">
            <div class="col-sm-4">
                <div class="card" style="width:400px">
                    <img class="card-img-top" src="image/Karlphoto.png" alt="Card image" style="width:50%">
                    <div class="card-body">
                        <h4 class="card-title">{{ $user->name }}</h4>
                        <p class="card-text"></p>
                        <a href="#" class="btn btn-primary">See Profile</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    Message
                    <br><br><br><br><br><br><br><br><br><br><br><br><br>
                </div>
            </div>
        </div>
    @endif

@endsection
