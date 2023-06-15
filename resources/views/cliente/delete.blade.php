<x-layout title="Excluir Cliente">
    <form id="delete-form" action="{{ route('cliente.destroy', $cliente->id) }}" method="post" onsubmit="return confirm('Deseja excluir este cliente?');">
        @csrf
        @method('DELETE')

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $cliente->nome }}">
        </div>
    
        <button type="submit">Excluir</button>
    </form>
</x-layout>