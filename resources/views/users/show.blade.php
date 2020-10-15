@extends('layouts.app')

@section('content')

    @if(isset($error))
        <h1>{{ $error }}</h1>
    @else
        @if(session('success'))
            <h1>{{ session('success') }}</h1>
        @endif
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
                            <a href="{{route('edit_profile',$user->slugFullName())}}" class="">Modifier
                                le profil</a>
                            <form action="{{route('user_delete',$user->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="bouton-supprimer" type="submit">
                                    Supprimer profil
                                </button>

                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @if(Auth::user()->id == $user->id)
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

                {{--        LES ENFANTS        --}}
                @if(Auth::user()->hasGroup('Parent'))
                    <div class="col-sm-8">
                        <div class="message card">
                            <div class="message-title">Les cours de mes enfants</div>
                            <div class="message-content">
                                @foreach($user->children as $child)
                                    <h3>{{ $child->fullName() }}</h3>
                                    <ul>
                                        @foreach($child->orders as $order)
                                            <li>
                                                <a href="{{ route('courses.show', $order->course) }}">{{ $order->course->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="message card">
                            <div class="message-title">Mes enfants</div>
                            <div class="message-content">
                                @foreach($user->children as $child)
                                    <li>
                                        <a href="{{ route('user_profile', $child->slugFullName()) }}">{{ $child->fullName() }}</a>
                                        <form action="{{ route('children.destroy', $child) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Supprimer</button>
                                        </form>
                                    </li>
                                @endforeach
                                <hr>
                                <h3>Ajouter un enfant</h3>
                                <form action="{{ route('children.store') }}" method="post">
                                    @csrf
                                    <select name="child">
                                        @foreach($children as $child)
                                            <option value="{{ $child->id }}">{{ $child->fullName() }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit">Valider</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

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
                                                <a href="{{ url('courses/show',$order["order"]->course->id) }}"><b>{{ $order["order"]->course->name }}</b></a> : </b>
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
