<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = null;
        try {
            $validatedData = $request->validate([
                'nome' => 'required|min:4|max:60',
                'idade' => 'required|integer',
                'email' => 'required|email|max:60',
                'sexo' => 'nullable|in:M,F',
                'senha' => 'required|min:6|confirmed',
            ], [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.min' => 'O campo nome deve ter no mínimo 4 caracteres.',
                'nome.max' => 'O campo nome deve ter no máximo 60 caracteres.',
                'idade.required' => 'O campo idade é obrigatório.',
                'idade.integer' => 'O campo idade deve ser um número inteiro.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um endereço de email válido.',
                'email.max' => 'O campo email deve ter no máximo 60 caracteres.',
                'sexo.in' => 'O campo sexo deve ser "M" ou "F".',
                'senha.required' => 'O campo senha é obrigatório.',
                'senha.min' => 'O campo senha deve ter no mínimo 6 caracteres.',
                'senha.confirmed' => 'A confirmação da senha não corresponde.',
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
                'nome' => 'required|min:4|max:60',
                'idade' => 'required|integer',
                'email' => 'required|email|max:60',
                'sexo' => 'nullable|in:M,F',
                'senha' => 'required|min:6|confirmed',
            ], [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.min' => 'O campo nome deve ter no mínimo 4 caracteres.',
                'nome.max' => 'O campo nome deve ter no máximo 60 caracteres.',
                'idade.required' => 'O campo idade é obrigatório.',
                'idade.integer' => 'O campo idade deve ser um número inteiro.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um endereço de email válido.',
                'email.max' => 'O campo email deve ter no máximo 60 caracteres.',
                'sexo.in' => 'O campo sexo deve ser "M" ou "F".',
                'senha.required' => 'O campo senha é obrigatório.',
                'senha.min' => 'O campo senha deve ter no mínimo 6 caracteres.',
                'senha.confirmed' => 'A confirmação da senha não corresponde.',
            ]);
            $validatedData['senha'] = bcrypt($validatedData['senha']);
            $model = Pessoa::findOrFail($id);
            $model->update($validatedData);

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
