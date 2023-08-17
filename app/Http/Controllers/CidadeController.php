<?php

namespace App\Http\Controllers;
use App\Models\Cidade;
class CidadeController extends Controller
{
    public function getCidades()
    {
        $Cidades = Cidade::all();
        return response()->json($Cidades);
    }
}
