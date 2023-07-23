<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
            'nome' => 'required|unique:clientes, nome|max:255,'.$this->id,
            'email' => 'required|email|unique:clientes, email|max:255,'.$this->id,
            'genero' => 'required|in:M,F',
            'telefone' => 'required|max:20',
            'cep' => 'required|max:10',
            'logradouro' => 'nullable',
            'complemento' => 'required|max:255',
            'bairro' => 'required|max:255',
            'localidade' => 'required|max:255',
            'uf' => 'required|max:2'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.unique' => 'O nome informado já está em uso.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email informado não é válido.',
            'email.unique' => 'O email informado já está em uso.',
            'email.max' => 'O email não pode ter mais de 255 caracteres.',

            'genero.required' => 'O campo gênero é obrigatório.',
            'genero.in' => 'O gênero informado é inválido. Por favor, escolha Masculino ou Feminino.',

            'telefone.required' => 'O campo telefone é obrigatório.',
            'telefone.max' => 'O telefone não pode ter mais de 20 caracteres.',

            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.max' => 'O CEP não pode ter mais de 10 caracteres.',

            'logradouro.required' => 'O campo logradouro é obrigatório.',

            'complemento.required' => 'O campo complemento é obrigatório.',
            'complemento.max' => 'O complemento não pode ter mais de 255 caracteres.',

            'bairro.required' => 'O campo bairro é obrigatório.',
            'bairro.max' => 'O bairro não pode ter mais de 255 caracteres.',

            'localidade.required' => 'O campo localidade é obrigatório.',
            'localidade.max' => 'A localidade não pode ter mais de 255 caracteres.',

            'uf.required' => 'O campo UF é obrigatório.',
            'uf.max' => 'O UF não pode ter mais de 2 caracteres.'
        ];
    }
}
