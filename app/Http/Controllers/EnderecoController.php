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
            return response()->json(['message' => 'Erro ao atualizar endereco: ' . $e->getMessage()], 500);
        }
    }
}
