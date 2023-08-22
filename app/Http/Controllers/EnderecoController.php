<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Http\Requests\EnderecoRequest;
class EnderecoController extends Controller
{
    public function store(EnderecoRequest $request)
    {
        try {
            // Remover hífens e pontos do CEP
            $cep = str_replace(['-', '.'], '', $request['cep']);
            $request['cep'] = $cep;

            $model = Endereco::create($request);
            return response()->json($model, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar endereço: ' . $e->getMessage()], 422);
        }
    }
    public function atualizarEndereco(EnderecoRequest $request, $enderecoId = null)
    {
        try {
            $pessoaId = $request->input('pessoa_id');
            if ($enderecoId) {
                $model = Endereco::where('id', $enderecoId)
                    ->where('pessoa_id', $pessoaId)
                    ->firstOrFail();
            }
            $cep = str_replace(['-', '.'], '', $request['cep']);
            $request['cep'] = $cep;
            if ($model) {
                $model->update($request);
            } else {
                Endereco::create($request);
            }
            return response()->json(['message' => 'Endereco atualizado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar endereco: ' . $e->getMessage()], 422);
        }
    }
}
