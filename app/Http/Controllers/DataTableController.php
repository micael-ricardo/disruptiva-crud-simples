<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;


class DataTableController extends Controller
{
    public function listar()
    {
        $model = Pessoa::with('Enderecos')->get();
        $data = ['data' => $model];
        return response()->json($data);
    }
}