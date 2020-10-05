@extends('layouts.app')

<head>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

@section('content')
<div class="container home">
    <section class="tiles">
        <article class="style1">
                <span class="image">
                    <img src="image/maths.jpg" height="150px" width="225px">
                </span>
            <a href="http://127.0.0.1:8000/courses/mathematiques">
                <h2>MATHEMATIQUES</h2>
                <div class="content">
                    <p>Grâce à ce cours, tu saura compter jusqu'à au moins 1000 !</p>
                </div>
            </a>
        </article>

        <article class="style2">
            <span class="image">
                <img src="image/france.jpg" height="150px" width="225px">
            </span>
            <a href="http://127.0.0.1:8000/courses/francais">
                <h2>FRANÇAIS</h2>
                <div class="content">
                    <p>Apprend à parler la France.</p>
                </div>
            </a>
        </article>

        <article class="style4">
            <span class="image">
                <img src="image/mapMonde.jpg" height="150px" width="225px">
            </span>
            <a href="http://127.0.0.1:8000/courses/geographie">
                <h2>GÉOGRAPHIE</h2>
                <div class="content">
                    <p>Devient un expert en géographie et tu trouvera peut-être le One Piece !</p>
                </div>
            </a>
        </article>

        <article class="style3">
            <span class="image">
                <img src="image/histoire.jpg" height="150px" width="225px">
            </span>
            <a href="http://127.0.0.1:8000/courses/histoire">
                <h2>HISTOIRE</h2>
                <div class="content">
                    <p>Découvre tous les secrets de l'histoire de France, et tu pourras te la péter en soirée !</p>
                </div>
            </a>
        </article>

        <article class="style6">
            <span class="image">
                <img src="image/espagne.png" height="150px" width="225px">
            </span>
            <a href="http://127.0.0.1:8000/courses/espagnol">
                <h2>ESPAGNOL</h2>
                <div class="content">
                    <p>no habla español...</p>
                </div>
            </a>
        </article>

        <article class="style5">
            <span class="image">
                <img src="image/britannique.jpg" height="150px" width="225px">
            </span>
            <a href="http://127.0.0.1:8000/courses/anglais">
                <h2>ANGLAIS</h2>
                <div class="content">
                    <p>Of course and you ?</p>
                </div>
            </a>
        </article>
    </section>
</div>
@endsection
