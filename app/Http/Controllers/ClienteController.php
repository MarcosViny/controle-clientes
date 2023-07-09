<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();

        return view('cliente.index', ['clientes' => $clientes]);
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('cliente.show', ['cliente' => $cliente]);
    }

    public function create()
    {
        return view('cliente.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $cliente = Cliente::create([
                'nome' => $request->nome,
                'email' => $request->email,
                'genero' => $request->genero,
            'telefone' => limpa_telefone($request->telefone)
            ]);

            if (!$cliente) {
                throw new Exception("Falha ao cadastrar o cliente.");
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

            return "Cliente criado com sucesso!";
        } catch (Exception $e) {
            DB::rollback();

            return "Ocorreu um erro ao cadastrar o cliente. Erro: " . $e->getMessage();
        }
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        if (!$cliente) {
            // 'Cliente não encontrado'
        } else {
            $cliente->telefone_formatado = formatarTelefone($cliente->telefone);
        }

        $endereco = Endereco::where('cliente_id', $id)->first();

        if (!$endereco) {
            // 'Endereço não encontrado'
        } else {
            $endereco->cep_formatado = formatarCep($endereco->cep);
        }

        return view('cliente.edit', compact('cliente', 'endereco'));
    }

    public function update(Request $request, $idCliente)
    {
        $cliente = Cliente::findOrFail($idCliente);

        $clienteAtualizado = $cliente->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'genero' => $request->genero,
            'telefone' => limpa_telefone($request->telefone)

        ]);

        if ($clienteAtualizado) {
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

            if ($enderecoAtualizado) {
                return "Cliente atualizado com Sucesso!";
            }
        }
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        if ($cliente->delete()) {
            return "Cliente removido com sucesso!";
        }

        return "Ocorreu um erro ao remover o cliente.";
    }
}
