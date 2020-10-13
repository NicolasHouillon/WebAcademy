@extends('layouts.app')

@section('content')

    @if(isset($error))
        <h1>{{ $error }}</h1>
    @else
        <div class="container show">
            <div class="content">
            <div class="col-sm-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset($user->avatar)}}" alt="Card image">
                    <div class="card-body">
                        <p class="" style="font-weight: bold">{{ $user->firstname }}</p>
                        <p class="">{{ $user->lastname }}</p>
                        <p class="">{{ $user->email }}</p>
                        @if(Auth::user()->firstname == $user->firstname)
                            <a href="{{route('edit_profile',$user->slugFullName())}}" class="btn btn-primary">Modifier
                                le profil</a>
                        @endif
                    </div>
                </div>
            </div>
            @if(Auth::user()->firstname == $user->firstname)
                <div class="col-sm-8">
                    <div class="message card">
                        <div class="message-title">
                            Messages
                        </div>
                        <div class="message-content" style="font-weight: lighter">
                            @if(Auth::user()->reveived_messages == null)
                                Aucun message
                            @else

                            @endif
                        </div>
                    </div>
                </div>

                {{--        LES NOTIFICATIONS     --}}
                @if($user->group->name == "Professeur")
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="message-title">
                                Notification
                            </div>
                            @if($user->unreadNotifications->isEmpty())
                                <div class="message-content">Aucune notification</div>
                            @else
                                <div class="message-content">Vous avez {{ $user->unreadNotifications->count() }} notifications</div>
                                <div class="card-body">
                                    <ul>
                                        @foreach($user->unreadNotifications as $notif)
                                            <li style="font-size: .9em">
                                                {{ $notif->data['payer'] }} a acheté votre cours
                                                <b><i>{{ $notif->data['course'] }}</i></b>
                                                le {{ strftime("%d %m %Y", (new DateTime($notif->data['date']))->getTimestamp()) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{--        LES COURS ACHETES        --}}
                @if($user->group->name == "Etudiant")
                        <div class="card">
                            <div class="message-title">
                            Cours achetés
                            </div>
                            @foreach($orders as $order)

                                        <div class="message-content">
                                            <p>
                                                <a href="{{ url('courses/show',$order["order"]->course->id) }}"><b>{{ $order["order"]->course->name }}</a> : </b>
                                                Paiment de {{ $order["details"]->purchase_units[0]->amount->value }}€
                                                le {{ date_format($order["order"]->course->created_at, "d/m/Y") }}
                                            </p>
                                        </div>
                            @endforeach
                        </div>
                @endif
            @endif
            @if($user->group->name == "Professeur")
                <div class="col-sm-12">
                    <div class="card">
                        <div class="message-title">
                            Cours proposés
                        </div>
                        <div class="message-content">
                            @foreach($mesCours as $cours)
                                <p><a href="{{ url('courses/show',$cours->id) }}">{{$cours->name}}</a></p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        </div>
    @endif
@endsection
