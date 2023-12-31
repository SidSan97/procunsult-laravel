<?php

namespace App\Http\Controllers;

use App\Models\AnexoModel;
use App\Models\CriarChamadoModel;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use App\Http\Controllers\Auth;
use App\Models\HistoricoChamadaModel;

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

            /*return response()->json([
               $response
            ], 403);*/

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

            $this->historicoChamado($request->descricao, "Cliente", $user->id);

            $response = [
                'status' => 200,
                'message' => "Chamado aberto com sucesso",
            ];

            /*return response()->json([
               $response
            ], 200);*/

            return view('abrir-chamado')->with('jsonData', json_encode($response));

        } else {

            $response = [
                'status' => 500,
                'message' => "Erro ao processar a operação.",
            ];

            /*return response()->json([
               $response
            ], 500);*/

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

    public function historicoChamado($descricao, $nivel, $id) {

        $chamado = new HistoricoChamadaModel();

        $chamado->resposta  = $descricao;
        $chamado->nivel     = $nivel;
        $chamado->chamado_id = $id;

        $chamado->save();

        return;
    }
}
