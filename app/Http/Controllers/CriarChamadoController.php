<?php

namespace App\Http\Controllers;

use App\Models\CriarChamadoModel;
use Illuminate\Http\Request;

class CriarChamadoController extends Controller
{
    public function abrirChamado(Request $request) {

        $user = new CriarChamadoModel();

        $user->titulo    = $request->titulo;
        $user->descricao = $request->descricao;
        $user->resposta  = $request->resposta;
        $user->status    = $request->status;

        if($user->save()) {


        }
    }
}
