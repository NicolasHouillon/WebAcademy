<head>
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
</head>

<html>
<body>
@guest
    <div class="footer" style="top: 100%">
        <p>Ceci est le footer.</p>
    </div>
@elseif(url()->full() == url('http://127.0.0.1:8000/@'.Auth::user()->slugFullName().'/edit'))
    <div class="footer" style="top: 110%">
        <p>Ceci est le footer.</p>
    </div>
@elseif(url()->full() == url('http://127.0.0.1:8000/@'.Auth::user()->slugFullName()))
    <div class="footer" style="top: 150%">
        <p>Ceci est le footer.</p>
    </div>
@else
    <div class="footer" style="top: 100%">
        <p>Ceci est le footer.</p>
    </div>
@endif
</body>
</html>

