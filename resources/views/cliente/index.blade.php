<x-layout title="Lista de Clientes">
    <div class="d-flex justify-content-end">
        <a href="{{ route('cliente.create') }}" class="btn btn-dark mb-2">Adicionar Cliente</a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Sexo</th>
                <th>Telefone</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @if ($clientes->count() == 0)
                <tr>
                    <td colspan="6">Não foram encontrados clientes cadastrados.</td>
                </tr>
            @endif

            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->genero }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('cliente.edit', $cliente->id); }}" class="btn btn-primary me-2">Editar</a>

                        <form action="{{ route('cliente.delete', $cliente->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este cliente?');">
                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-danger">Remover</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>