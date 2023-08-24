<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;

class DataTableController extends Controller
{
    public function listar()
    {
        $draw = request()->input('draw');
        $start = request()->input('start');
        $length =  request()->input('length');
        $searchValue =  request()->input('search.value');
        $orderColumn =  request()->input('columns')[request()->input('order')[0]['column']]['data'];
        $orderDirection =  request()->input('order')[0]['dir'];

        $query = Pessoa::with('enderecos.cidade');

        // filtro 
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('nome', 'like', '%' . $searchValue . '%')
                    ->orWhere('idade', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%')
                    ->orWhere('sexo', 'like', '%' . $searchValue . '%')
                    ->orWhereHas('enderecos', function ($query) use ($searchValue) {
                        $query->where('logradouro', 'like', '%' . $searchValue . '%')
                            ->orWhere('bairro', 'like', '%' . $searchValue . '%')
                            ->orWhereHas('cidade', function ($query) use ($searchValue) {
                                $query->where('nome', 'like', '%' . $searchValue . '%');
                            });
                    });
            });
        }
        // total de registros antes da paginação
        $totalRecords = $query->count();
        // ordenação
        $query->orderBy($orderColumn, $orderDirection);
        // Aplicar paginação
        $query->skip($start)->take($length);
        $model = $query->get();

        $response = [
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $model,
        ];
        return response()->json($response);
    }
}
