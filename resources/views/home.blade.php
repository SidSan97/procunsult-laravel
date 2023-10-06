<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>
</head>
<body>

    @if(isset($jsonData))
        @if(json_decode($jsonData)->status == 403)
            <div class="mt-4 alert alert-success" role="alert">
                <span class="text-dark">{{ json_decode($jsonData)->message }}</span>
            </div>
        @endif
    @endif

    @guest
    <h1>Você precisa estar logado para usar o sistema</h1> <br>

    <div>
        <p><a href="/login">Login</a></p>
        <p><a href="/register">Registrar</a></p>
    </div>
    @endguest

    <br>

    @auth
    <h1>Bem-vindo, {{ Auth::user()->name;}}</h1> <br>
    <h3>Nivel: {{ Auth::user()->nivel;}}</h3>

    <div>
        @if( Auth::user()->nivel == "Cliente")
            <p><a href="/abrir-chamado">Abrir chamado</a></p>
        @elseif( Auth::user()->nivel == "Colaborador")
            <p><a href="/responder-chamado">Responder chamado</a></p>
        @endif
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit(); " role="button">
                <i class="fas fa-sign-out-alt"></i>

                {{ __('Log Out') }}
            </a>
        </div>
    </form>

    @endauth
</body>
</html>
