<x-layout title="Visualizar Cliente">
    <div>
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $cliente->nome }}">
        </div>
        <div>
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" value="{{ $cliente->email }}">
        </div>
        <div>
            <div>
                <span>Sexo:</span>
                <div>
                    <input type="radio" value="M" name="genero" id="genero_m" @if ($cliente->genero == 'M') checked @endif>
                    <label for="genero_m">Masculino</label>
                </div>
                <div>
                    <input type="radio" value="F" name="genero" id="genero_f" @if($cliente->genero == 'F') checked @endif>
                    <label for="genero_f">Feminino</label>
                </div>
            </div>
        </div>
        <div>
            <label for="telefone">Telefone:
                <input type="text" name="telefone" id="telefone" value="{{ $cliente->telefone }}">
        </div>
    </div>
</x-layout>