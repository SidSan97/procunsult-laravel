<?php

namespace App\Http\Controllers;

use App\Models\AnexoModel;
use App\Models\CriarChamadoModel;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use App\Http\Controllers\Auth;

class CriarChamadoController extends Controller
{
    public function index() {

        if(auth()->user()->nivel == "Cliente") {
            return view('abrir-chamado');

        } else {

            $response = [
                'status' => 403,
                'message' => "Você não tem permissão para acessar esta página",
            ];

            return view('home')->with('jsonData', json_encode($response));
        }
    }

    public function abrirChamado(Request $request) {

        $user = new CriarChamadoModel();

        $user->titulo    = $request->titulo;
        $user->descricao = $request->descricao;
        $user->resposta  = $request->resposta;
        $user->status    = "Aberto";
        $user->chamado_id_user = $request->valor;

        if($user->save()) {

            if ($request->hasFile('file')) {

                $id = $user->id;
                $qtdArquivos = sizeof($request->file);
                $arquivos    = $request->file;

                $this->upload($id, $arquivos, $qtdArquivos);
            }

            $response = [
                'status' => 200,
                'message' => "Chamado aberto com sucesso",
            ];

            return view('abrir-chamado')->with('jsonData', json_encode($response));

        } else {

            $response = [
                'status' => 500,
                'message' => "Erro ao processar a operação.",
            ];

            return view('abrir-chamado')->with('jsonData', json_encode($response));

        }

    }

    public function upload($id, $file, $tam)
    {

        for($i = 0; $i<$tam; $i++)
        {
            $requestFile = $file[$i];

            $extension   = $requestFile->extension();

            $requestName = md5($requestFile->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $file[$i]->move(public_path('uploads'), $requestName);

            $anexos = new AnexoModel();
            $anexos->chamado_id = $id;
            $anexos->nome_anexo = $requestName;

            $anexos->save();
        }

        return;

    }
}
