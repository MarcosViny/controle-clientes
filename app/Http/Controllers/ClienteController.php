<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Http\Requests\ClienteFormRequest;
use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{

    protected $model;

    public function __construct(Cliente $cliente)
    {
        $this->model = $cliente;
    }

    public function index()
    {
        $clientes = $this->model->all();

        return view('cliente.index', compact('clientes'));
    }

    public function show($id)
    {
        $cliente = $this->model->findOrFail($id);

        return view('cliente.show', compact('cliente'));
    }

    public function create()
    {
        return view('cliente.create');
    }

    public function store(ClienteFormRequest $request, ClienteRepository $repository)
    {
        $resultado = $repository->store($request);

        return $resultado['msg'];
    }

    public function edit($id)
    {
        $cliente = $this->model->findOrFail($id);
        if (!$cliente) {
            return 'Cliente não encontrado';
        }

        $endereco = Endereco::where('cliente_id', $id)->first();
        if (!$endereco) {
            return 'Endereço não encontrado';
        }

        return view('cliente.edit', compact('cliente', 'endereco'));
    }

    public function update(ClienteFormRequest $request, ClienteRepository $repository, int $idCliente)
    {
        $resultado = $repository->update($request, $idCliente);

        return $resultado;
    }

    public function destroy($id)
    {
        $cliente = $this->model->findOrFail($id);

        if ($cliente->delete()) {
            return "Cliente removido com sucesso!";
        }

        return "Ocorreu um erro ao remover o cliente.";
    }
}
