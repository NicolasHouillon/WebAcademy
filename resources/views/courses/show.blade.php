@extends('layouts.app')
<head>
    <link rel="stylesheet" href="{{ asset('css/courses.css') }}">
</head>
@section('content')
    <div class="course-content">
        @if(!$course->valide)
            <h1>Cours en attente de validation.</h1>
        @endif

        @if(isset($error))
            <h1>{{ $error }}</h1>
        @else
            @if($errors->any())
                <p>{{ $errors->first() }}</p>
            @endif
            <h1>
                Le cours {{ $course->name }} publié par <a
                    href="{{ url('@'.$course->user->slugFullName()) }}">{{ $course->user->fullName() }}</a>
            </h1>

            @if($course->valide)
                <p>
                    {{$course->description}}
                </p>
            @endif
            @if(Auth::user()->payCourse($course->id) || (Auth::id()==$course->user_id && Auth::user()->group_id==2) || Auth::user()->group->id == "Administrateur" && $course->valide)
                <p>
                <ul>
                    @foreach($course->attachments as $attachment)
                        <li>
                            <a href="{{asset('storage/'.$attachment->file)}}">
                                {{$attachment->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
                </p>
            @endif


            <p>
                @if(Auth::id()==$course->user_id && Auth::user()->group_id==2)
                    <a href="{{ route('courses.edit', $course) }}">Modifier</a>
                @endif
                @if((Auth::user()->group_id==3 || Auth::user()->group_id==4) && !Auth::user()->payCourse($course->id))
                    <a href="{{ route('make.payment', $course) }}">Payer {{ $course->price }}€</a>
                @endif
            </p>

        @endif
    </div>

@endsection
@extends('layouts.footer')
