<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Meus Chamados</title>
</head>
<body>

    <div class="container">
        <h2 align="center">Listar chamados</h2> <br>

        <button type="button" class="btn btn-secondary"><a href="/abrir-chamado" class="text-light">Voltar</a></button>

        <table class="table">
            <thead>
				<tr>
					<th scope="col">Nº chamado</th>
					<th scope="col">Titulo</th>
					<th scope="col">Descricao</th>
					<th scope="col">Status</th>
                    <th scope="col">Opções</th>
				</tr>
			</thead>

            <tbody>
                @if(isset($chamados))
                    @foreach($chamados as $chamado)
                    <tr>
                        <td>{{$chamado->id}}</td>
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
						        Ver historico
					        </button>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop<?=$chamado->id?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Historico do chamado</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <strong><span>HISTORICO DE RESPOSTA</span></strong> <br><br>

                                    @foreach($chamado->historicoChamado as $historico)
                                        <br> <span><strong>{{$historico->nivel}}:</strong> {{$historico->resposta}} - {{$historico->updated_at}}</span> <br>
                                    @endforeach

                                    <form action="/envio-resposta-cliente" method="post">
                                        @csrf
                                        <input type="hidden" name="chamado" value="{{$historico->chamado_id}}">
                                        <input type="hidden" name="nivel" value="Cliente">
                                        <input type="hidden" name="valor" value="{{$chamado->chamado_id_user}}">

                                        <br>

                                        <label for="descricao" class="form-label">Envie sua resposta</label>
                                        <textarea type="text" class="form-control" id="resposta" name="resposta" rows="2" ></textarea>

                                        <br>

                                        <button type="submit" class="btn btn-primary">Responder</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
