<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'pessoa_id' => 'required|integer',
            'cep' => 'nullable',
            'tipo_logradouro_id' => 'required|integer',
            'logradouro' => 'nullable|string|max:60',
            'numero' => 'nullable|string|max:10',
            'bairro' => 'nullable|string|max:60',
            'cidade_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
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
        ];
    }
}
