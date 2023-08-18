<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nome' => 'required|max:60',
                'idade' => 'required|integer',
                'email' => 'required|email|max:60',
                'sexo' => 'nullable|in:M,F',
                'senha' => 'required|min:6|confirmed',
            ]);
            $model = Pessoa::create($validatedData);
            return response()->json($model, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar pessoa: ' . $e->getMessage()], 422);
        }
    }

    public function deletePessoa($id)
    {
        try {
            $model = Pessoa::find($id);
            $model->delete();
            return response()->json(['message' => 'Pessoa removido com sucesso'], 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao deletar pessoa' . $e->getMessage()], 404);
        }
    }
}
