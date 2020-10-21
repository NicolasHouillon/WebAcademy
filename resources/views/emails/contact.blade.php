@component('mail:message')
    <h1>{{ $user }} vous a envoyé un email depuis l'adresse {{ $email }}.</h1>

    Voici son contenu :
    <p>
        {{ $message }}
    </p>
@endcomponent
