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
}
