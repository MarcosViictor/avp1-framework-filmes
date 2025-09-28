<!DOCTYPE html>
<html>
<head>
    <title>Controle de Filmes</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('movies.index') }}">Meus Filmes</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button>Sair</button>
            </form>
        </nav>
    </header>

    <main>
        @if(session('success'))
            <div style="color:green">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
