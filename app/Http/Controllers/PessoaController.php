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

            $validatedData['senha'] = bcrypt($validatedData['senha']);
            $model = Pessoa::create($validatedData);
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

    public function atualizarPessoa(Request $request, $id)
    {
        $request->merge(['pessoa_id' => $request->input('pessoa_endereco_Id')]);
        try {
            $validatedData = $request->validate([
                'nome' => 'required|max:60',
                'idade' => 'required|integer',
                'email' => 'required|email|max:60',
                'sexo' => 'nullable|in:M,F',
                'senha' => 'required|min:6|confirmed',
            ]);
            $validatedData['senha'] = bcrypt($validatedData['senha']);
            $model = Pessoa::findOrFail($id);
            $model->update($validatedData);

            return response()->json(['message' => 'Pessoa atualizado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar pessoa'], 500);
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
