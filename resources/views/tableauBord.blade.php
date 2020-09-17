@extends('layouts.app')

@section('content')

<div class="container-md">
    <div class="col-sm-4">
        <div class="card" style="width:400px">
            <img class="card-img-top" src="image/Karlphoto.png" alt="Card image" style="width:50%">
            <div class="card-body">
                <h4 class="card-title">{{ Auth::user()->name }}</h4>
                <p class="card-text"></p>
                <a href="#" class="btn btn-primary">See Profile</a>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="message">
            Message
        </div>
    </div>
</div>
@endsection
