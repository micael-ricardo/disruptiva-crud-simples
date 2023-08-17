<?php

namespace App\Http\Controllers;
use App\Models\TipoLogradouro;

class TipoLogradouroController extends Controller
{
    public function getTiposLogradouros()
    {
        $tiposLogradouros = TipoLogradouro::all();
        return response()->json($tiposLogradouros);
    }
}
