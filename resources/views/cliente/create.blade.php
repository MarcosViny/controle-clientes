<x-layout title="Cadastrar Cliente">
    <script src="/js/masks.js"></script>
    <script src="/js/cliente/endereco.js"></script>
    <form action="{{ route('cliente.store') }}" method="post">
        @csrf

        @include('cliente._partials.form')

        <button class="btn btn-primary mb-3" type="submit">Adicionar</button>

    </form>

    <script>
        $(document).ready(function() {
            habilitarMascaras();

            $('input[name=cep]').blur(function() {
                limparCamposEndereco();

                //Nova variável "cep" somente com dígitos
                let cep = $('#cep').val().replace(/\D/g, '');

                // Requisição Ajax para Consultar o CEP
                pesquisarCep(cep);
            });
        });   
    </script>
</x-layout>