@extends('layouts.app')

@section('content')
<div class="container home">
    <div class="row justify-content-center">

        <div class="card">
            <img src="public/image/maths.jpg">
            <a href="#">MATHEMATIQUES</a>
        </div>
        <div class="card">
            <img src="public/image/langues.jpg">
            <a href="#">LANGUES VIVANTES</a>
        </div>
        <div class="card">
            <img src="public/image/histoire.jpg">
            <a href="#">HISTOIRE</a>
        </div>
        <div class="card">
            <img src="public/image/sciences.jpg">
            <a href="#">SCIENCES</a>
        </div>
    </div>
</div>
@endsection
