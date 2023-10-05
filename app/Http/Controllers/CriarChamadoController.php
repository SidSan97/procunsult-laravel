<?php

namespace App\Http\Controllers;

use App\Models\CriarChamadoModel;
use Illuminate\Http\Request;

class CriarChamadoController extends Controller
{
    public function index() {

        return view('abrir-chamado');

    }


    public function abrirChamado(Request $request) {

        $user = new CriarChamadoModel();

        $user->titulo    = $request->titulo;
        $user->descricao = $request->descricao;
        $user->resposta  = $request->resposta;
        $user->status    = "Aberto";

        //$user->file = $requestName;

        if($user->save()) {

            if ($request->hasFile('file'))
                $this->upload($request->file);
            dd('inseriu');
        }
        else
        dd('nada');
    }

    public function upload($file)
    {
        //dd($file);
        $requestFile = $file;

        $extension = $requestFile->extension();

        $requestName = md5($requestFile->getClientOriginalName() . strtotime("now")) . "." . $extension;

        $file->move(public_path('uploads'), $requestName);
    }
}
