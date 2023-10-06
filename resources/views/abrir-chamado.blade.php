<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>

<div class="container">

    <h2 align="center">Abertura de chamado</h2> <br>

    @if(isset($jsonData))
        @if(json_decode($jsonData)->status == 200)
            <div class="mt-4 alert alert-success" role="alert">
                <span class="text-dark">{{ json_decode($jsonData)->message }}</span>
            </div>
        @else
            <div class="mt-4 alert alert-danger" role="alert">
                <span class="text-dark">{{ json_decode($jsonData)->message }}</span>
            </div>
        @endif
    @endif

    <form action="/enviar-chamado" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="valor" value="{{Auth::user()->id}}">
        <div class="form-group">
            <label for="titulo">Titulo do chamado</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Insira um nome para o chamado" required>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" rows="3" name="descricao" required></textarea>
        </div>

        <div class="form-group mb-4">
            <label for="file">Escolher arquivos</label> <br>
            <input type="file" class="form-control-file" name="file[]" multiple id="file">
        </div>

        <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
    </form>

    <br>

    <button type="button" class="btn btn-warning"><a href="/" class="text-dark">Voltar</a></button>
    <button type="button" class="btn btn-success"><a href="/meus-chamados/{{Auth::user()->id}}" class="text-dark">Ver meus chamados</a></button>
</div>

<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
