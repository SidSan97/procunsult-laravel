<?php

namespace App\Http\Controllers;

use App\Models\MeuChamadoModel;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

class MeuChamadosController extends Controller
{
    public function listarChamados($id)  {

        if(auth()->user()->nivel == "Cliente") {

            $chamados = MeuChamadoModel::with('historicoChamado')
                    ->where('chamado_id_user', $id)
                    ->get();

            if($chamados) {

                $response = [
                    'status' => 200,
                    'dados'  => $chamados,
                ];

                /*return response()->json([
               $response
            ], 200);*/

                return view('meus-chamados', compact('chamados'));

            } else {

                $response = [
                    'status' => 404,
                    'dados'  => "Dados não encontrados",
                ];

                /*return response()->json([
               $response
            ], 404);*/

                return view('meus-chamados')->with('jsonData', json_encode($response));
            }

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

    public function envioResposta(Request $request) {

        $resposta = $request->resposta;
        $nivel    = $request->nivel;
        $chamado  = $request->chamado;
        $id       = $request->valor;

        $enviar = new CriarChamadoController;
        $enviar->historicoChamado($resposta, $nivel, $chamado);

        /*$response = [
            'status' => 200,
            'dados'  => "Resposta enviada com sucesso.",
        ];

        return response()->json([
               $response
            ], 200);*/

        return redirect('/meus-chamados/'.$id);
    }
}
