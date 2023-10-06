<?php

namespace App\Http\Controllers;

use App\Models\MeuChamadoModel;

class MeuChamadosController extends Controller
{
    public function listarChamados($id)  {

        $chamados = MeuChamadoModel::findOrfail($id);

        if($chamados) {

            $response = [
                'status' => 200,
                'dados'  => $chamados,
            ];

            return view('meus-chamados')->with('jsonData', json_encode($response));

        } else {

            $response = [
                'status' => 404,
                'dados'  => "Dados não encontrados",
            ];

            return view('meus-chamados')->with('jsonData', json_encode($response));
        }
    }
}
