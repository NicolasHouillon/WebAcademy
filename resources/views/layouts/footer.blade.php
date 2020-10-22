<footer class="footer">
    <div class="message">
        <a href="{{ route('contact') }}">
            Contacter un admin
        </a>
    </div>

    <ul class="liens">
        <p><b>Liens utiles :</b></p>
        <li>
            <a href="{{ route('index') }}">Accueil</a>
        </li>
        <li>
            <a href="{{ route('annuaire') }}">Annuaire</a>
        </li>
        @auth()
        <li>
            <a href="{{route('user_profile', ['name' => Auth::user()->slugFullName()])}}">Profil</a>
        </li>
        @endauth
        <br><br>
        <li>
            <a href="{{ route('messages') }}">Messages</a>
        </li>
        <li>
            <a href="#">Recrutement</a>
        </li>
    </ul>

    <ul class="createur">
        <p><b>Créateurs du site :</b></p>
        <li>
            CERNUTA Valentin
        </li>
        <li>
            BONNAIRE Eric
        </li>
        <br><br>
        <li>
            REMY Karl
        </li>
        <li>
            HOUILLON Nicolas
        </li>
    </ul>

</footer>

