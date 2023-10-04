<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>
</head>
<body>
    <h1>Você precisa estar logado para usar o sistema</h1> <br>

    @guest
    <div>
        <p><a href="/login">Login</a></p>
        <p><a href="/register">Registrar</a></p>
    </div>
    @endguest

    <br>

    @auth
    <div>
        <p><a href="/abrir-chamado">Abrir chamado</a></p>
        <p><a href="/responder-chamado">Responder chamado</a></p>
    </div>
    @endauth
</body>
</html>
