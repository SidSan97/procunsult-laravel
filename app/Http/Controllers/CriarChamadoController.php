<?php

namespace App\Http\Controllers;

use App\Models\CriarChamadoModel;
use Illuminate\Http\Request;

class CriarChamadoController extends Controller
{
    public function abrirChamado(Request $request) {

        $user = new CriarChamadoModel();
    }
}
