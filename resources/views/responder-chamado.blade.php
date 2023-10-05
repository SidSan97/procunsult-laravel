<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Responder Chamado</title>
</head>
<body>
    <div class="container">
        <h2 align="center">Listar chamados</h2> <br>

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

        <button type="button" class="btn btn-secondary"><a href="/" class="text-light">Voltar</a></button>

        <table class="table">
            <thead>
				<tr>
					<th scope="col">Titulo</th>
					<th scope="col">Descrição</th>
					<th scope="col">Status</th>
					<th scope="col">Opções</th>
				</tr>
			</thead>

            <tbody>
                @if(isset($chamados))
                @foreach($chamados as $chamado)
                    <tr>
                        <td>{{$chamado->titulo}}</td>
                        <td>{{$chamado->descricao}}</td>
                        <td>
                            @if($chamado->status == "Aberto")
                                <span class="text-success">{{$chamado->status}}</span>
                            @elseif($chamado->status == "Em andamento")
                                <span class="text-warning">{{$chamado->status}}</span>
                            @elseif($chamado->status == "Finalizado")
                                <span class="text-danger">{{$chamado->status}}</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?=$chamado->id?>">
						        Ver chamado
					        </button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop<?=$chamado->id?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Detalhes do chamado</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="/editar-chamado/<?=$chamado->id?>" method="post">
                                        @csrf
                                        @method('PUT')
                                        <strong>STATUS: {{$chamado->status }}</strong>
                                        <div class="mb-3">
                                            <label for="titulo" class="form-label">Titulo</label>
                                            <input type="text" class="form-control" id="titulo" name="titulo" readonly value="<?= $chamado->titulo ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="descricao" class="form-label">Descrição</label>
                                            <textarea type="text" class="form-control" id="descricao" name="descricao" rows="2" readonly>
                                                {{ $chamado->descricao }}
                                            </textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Resposta para o chamado</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="resposta" required <?php if($chamado->status == "Finalizado"):?> readonly <?php endif?>>
                                                {{ $chamado->resposta }}
                                            </textarea>
                                        </div>

                                        <div class="mb-3">
                                            <span>Anexos:</span>

                                            @foreach($chamado->anexos as $anexo)
                                               <p><a href="/uploads/<?= $anexo->nome_anexo ?>">Ver anexo</a></p>
                                            @endforeach
                                        </div>

                                        @if($chamado->status != "Finalizado")
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="finalizado" name="finalizado" id="defaultCheck1">

                                                <strong>
                                                    <label class="form-check-label text-danger" for="defaultCheck1">
                                                        Finalizar chamado
                                                    </label>
                                                </strong>
                                            </div>
                                        @endif

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                                            @if($chamado->status != "Finalizado")
                                                <button type="submit" class="btn btn-primary" name="enviar">Responder</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </tbody>
        </table>

        <!-- Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
</body>
</html>
