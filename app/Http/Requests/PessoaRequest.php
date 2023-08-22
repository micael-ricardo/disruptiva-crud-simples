<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
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
            'nome' => 'required|min:4|max:60',
            'idade' => 'required|integer',
            'email' => 'required|email|max:60',
            'sexo' => 'nullable|in:M,F',
            'senha' => 'required|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
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
        ];
    }
}
