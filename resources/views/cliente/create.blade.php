<x-layout title="Cadastrar Cliente">
    <form action="{{ route('cliente.store') }}" method="post">
        @csrf
        <div>
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome">
            </div>
            <div>
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email">
            </div>
            <div>
                <div>
                    <span>Sexo:</span>
                    <div>
                        <input type="radio" value="M" name="genero" id="genero_m">
                        <label for="genero_m">Masculino</label>
                    </div>
                    <div>
                        <input type="radio" value="F" name="genero" id="genero_f">
                        <label for="genero_f">Feminino</label>
                    </div>
                </div>
            </div>
            <div>
                <label for="telefone">Telefone:
                    <input type="text" name="telefone" id="telefone">
            </div>
        </div>

        <button type="submit">Adicionar</button>
    </form>
</x-layout>