<?php

namespace App\Http\Controllers;

use App\Models\ResponderChamadoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResponderChamadoController extends Controller
{
    public function index() {

        return view('responder-chamado');
    }

    public function obterDados() {

        $chamados = ResponderChamadoModel::with('anexos')->get();

        return view('responder-chamado', compact('chamados'));
    }

    public function responderChamado(Request $request, $id) {

        $chamado = ResponderChamadoModel::findOrfail($id);

        $chamado->titulo    = $request->input('titulo');
        $chamado->descricao = $request->input('descricao');
        $chamado->resposta  = $request->input('resposta');

        if(isset($request->finalizado))
            $chamado->status = "Finalizado";
        else
            $chamado->status = "Em andamento";

        if($chamado->save()) {

            $response = [
                'status' => 200,
                'message' => "Chamado aberto com sucesso",
            ];

            return view('responder-chamado')->with('jsonData', json_encode($response));

            }else {

                $response = [
                    'status' => 500,
                    'message' => "Erro ao processar a operação.",
                ];

                return view('responder-chamado')->with('jsonData', json_encode($response));
            }
        }

}
