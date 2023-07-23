<x-layout title="Atualizar Cliente">
    <script src="/js/masks.js"></script>

    <form action="{{ route('cliente.update', $cliente->id) }}" method="post">
        @csrf
        @method('put')

        @include('cliente._partials.form')

        <button type="submit" class="btn btn-primary my-3">Atualizar</button>
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