@extends('layouts.app')

<head>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
@section('content')
<div class="container home">
    <section class="tiles">
    @foreach($subjects as $sub)
        <article class="style1">
                <span class="image">
                    <img src="{{ asset($sub->url) }}" height="150px" width="225px">
                </span>
            <a href="{{ route('courses.index', $sub->slug) }}">
                <h2>{{ $sub->name }}</h2>
                <div class="content">
                    <p>Grâce à ce cours, tu saura compter jusqu'à au moins 1000 !</p>
                </div>
            </a>
        </article>
    @endforeach
    </section>
</div>


@endsection

@extends('layouts.footer')


