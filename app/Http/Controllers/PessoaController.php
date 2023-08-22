<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Http\Requests\PessoaRequest;
class PessoaController extends Controller
{
    public function store(PessoaRequest $request)
    {  
        try { 
            $request['senha'] = bcrypt($request['senha']);
            $model = Pessoa::create($request->all());
            return response()->json($model, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar pessoa: ' . $e->getMessage()], 422);
        }
    }
    public function editarPessoa($id)
    {
        $pessoa = Pessoa::with('enderecos')->find($id);
        return view('cadastrar', compact('pessoa'));
    }
    public function atualizarPessoa(PessoaRequest $request, $id)
    {
        $request->merge(['pessoa_id' => $request->input('pessoa_endereco_Id')]);
        try {
            $request['senha'] = bcrypt($request['senha']);
            $model = Pessoa::findOrFail($id);
            $model->update($request->all());
            return response()->json(['message' => 'Pessoa atualizado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar pessoa: ' . $e->getMessage()], 422);
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
