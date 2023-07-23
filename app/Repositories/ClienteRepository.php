<?php

namespace App\Repositories;

use Exception;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Http\Requests\ClienteFormRequest;
use Illuminate\Support\Facades\DB;

class ClienteRepository
{
    protected $model;

    function __construct(Cliente $cliente)
    {
        $this->model = $cliente;
    }

    function store(ClienteFormRequest $request)
    {
        $retorno = array(
            'ok' => true,
            'msg' => 'Cliente cadastrado com sucesso!',
        );

        try {
            DB::beginTransaction();
            $cliente = $this->model->create([
                'nome' => $request->nome,
                'email' => $request->email,
                'genero' => $request->genero,
                'telefone' => limpa_telefone($request->telefone)
            ]);

            if (!$cliente) {
                throw new Exception("Falha ao cadastrar cliente.");
            }

            $endereco = Endereco::create([
                'cep' => limpa_cpf_cnpj($request->cep),
                'logradouro' => $request->logradouro,
                'complemento' => $request->complemento,
                'bairro' => $request->bairro,
                'localidade' => $request->localidade,
                'uf' => $request->uf,
                'cliente_id' => $cliente->id
            ]);

            if (!$endereco) {
                throw new Exception("Falha ao cadastrar o endereço do cliente.");
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            $retorno['ok'] = false;
            $retorno['msg'] = $e->getMessage();
        }

        return $retorno;
    }

    function update(ClienteFormRequest $request, int $idCliente)
    {
        $cliente = $this->model->findOrFail($idCliente);
        $clienteAtualizado = $cliente->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'genero' => $request->genero,
            'telefone' => limpa_telefone($request->telefone)

        ]);

        if (!$clienteAtualizado) {
            return "Falha ao atualizar o cliente.";
        }

        $endereco = Endereco::where('cliente_id', $idCliente)->first();
        $enderecoAtualizado = $endereco->update([
            'cep' => limpa_cpf_cnpj($request->cep),
            'logradouro' => $request->logradouro,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'localidade' => $request->localidade,
            'uf' => $request->uf,
            'cliente_id' => $cliente->id
        ]);

        if (!$enderecoAtualizado) {
            return "Falha ao atualizar o endereço do cliente.";
        }

        return "Cliente atualizado com Sucesso!";
    }
}
