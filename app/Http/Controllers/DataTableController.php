<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
class DataTableController extends Controller
{
    public function listar()
    {
        $draw = request()->input('draw');
        $page = request()->input('start') / request()->input('length') + 1;

        $model = Pessoa::with('enderecos.cidade')->paginate(5, ['*'], 'page', $page);
        $response = [
            'draw' => $draw,
            'recordsTotal' => $model->total(),
            'recordsFiltered' => $model->total(),
            'data' => $model->items(),
        ];

        return response()->json($response);
    }
}
