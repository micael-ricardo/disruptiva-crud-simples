<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;


class EnderecoController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'pessoa_id' => 'required|integer',
                'cep' => 'nullable',
                'tipo_logradouro_id' => 'required|integer',
                'logradouro' => 'nullable|string|max:60',
                'numero' => 'nullable|string|max:10',
                'bairro' => 'nullable|string|max:60',
                'cidade_id' => 'required|integer',
            ], [
                'pessoa_id.required' => 'O campo pessoa_id é obrigatório.',
                'pessoa_id.integer' => 'O campo pessoa_id deve ser um número inteiro.',
                'cep.nullable' => 'O campo CEP deve ser nulo ou estar no formato correto.',
                'tipo_logradouro_id.required' => 'O campo tipo_logradouro_id é obrigatório.',
                'tipo_logradouro_id.integer' => 'O campo tipo_logradouro_id deve ser um número inteiro.',
                'logradouro.nullable' => 'O campo logradouro deve ser nulo ou estar no formato correto.',
                'logradouro.max' => 'O campo logradouro deve ter no máximo 60 caracteres.',
                'numero.nullable' => 'O campo número deve ser nulo ou estar no formato correto.',
                'numero.max' => 'O campo número deve ter no máximo 10 caracteres.',
                'bairro.nullable' => 'O campo bairro deve ser nulo ou estar no formato correto.',
                'bairro.max' => 'O campo bairro deve ter no máximo 60 caracteres.',
                'cidade_id.required' => 'O campo cidade é obrigatório.',
                'cidade_id.integer' => 'O campo cidade_id deve ser um número inteiro.',
            ]);
            // Remover hífens e pontos do CEP
            $cep = str_replace(['-', '.'], '', $validatedData['cep']);
            $validatedData['cep'] = $cep;

            $model = Endereco::create($validatedData);
            return response()->json($model, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar endereço: ' . $e->getMessage()], 422);
        }
    }

    public function atualizarEndereco(Request $request, $enderecoId = null)
    {
        try {
            $pessoaId = $request->input('pessoa_id');

            if ($enderecoId) {
                $endereco = Endereco::where('id', $enderecoId)
                    ->where('pessoa_id', $pessoaId)
                    ->firstOrFail();
            }

            $validatedData = $request->validate([
                'pessoa_id' => 'required|integer',
                'cep' => 'nullable',
                'tipo_logradouro_id' => 'required|integer',
                'logradouro' => 'nullable|string|max:60',
                'numero' => 'nullable|string|max:10',
                'bairro' => 'nullable|string|max:60',
                'cidade_id' => 'required|integer',
            ], [
                'pessoa_id.required' => 'O campo pessoa_id é obrigatório.',
                'pessoa_id.integer' => 'O campo pessoa_id deve ser um número inteiro.',
                'cep.nullable' => 'O campo CEP deve ser nulo ou estar no formato correto.',
                'tipo_logradouro_id.required' => 'O campo tipo_logradouro_id é obrigatório.',
                'tipo_logradouro_id.integer' => 'O campo tipo_logradouro_id deve ser um número inteiro.',
                'logradouro.nullable' => 'O campo logradouro deve ser nulo ou estar no formato correto.',
                'logradouro.max' => 'O campo logradouro deve ter no máximo 60 caracteres.',
                'numero.nullable' => 'O campo número deve ser nulo ou estar no formato correto.',
                'numero.max' => 'O campo número deve ter no máximo 10 caracteres.',
                'bairro.nullable' => 'O campo bairro deve ser nulo ou estar no formato correto.',
                'bairro.max' => 'O campo bairro deve ter no máximo 60 caracteres.',
                'cidade_id.required' => 'O campo cidade é obrigatório.',
                'cidade_id.integer' => 'O campo cidade_id deve ser um número inteiro.',
            ]);
            $cep = str_replace(['-', '.'], '', $validatedData['cep']);
            $validatedData['cep'] = $cep;
            if ($endereco) {
                $endereco->update($validatedData);
            } else {
                Endereco::create($validatedData);
            }

            return response()->json(['message' => 'Endereco atualizado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar endereco: ' . $e->getMessage()], 422);
        }
    }
}
