<x-layout title="Atualizar Cliente">
    <script src="/js/masks.js"></script>

    <form action="{{ route('cliente.update', $cliente->id) }}" method="post">
        @csrf
        @method('put')

        <fieldset class="form-group border p-3">
            <legend class="w-auto float-none px-2">Dados Pessoais</legend>
            <div id="loading">
                <div class="containerCarregando">
                    <div id="gifCarregando">
                        <img src="/images/loading.gif" alt="Carregando...">
                    </div>
                    <span class="textoCarregando display-5 text-white"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="{{ $cliente->nome }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" name="email" id="email" value="{{ $cliente->email }}" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Sexo:</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="radio" value="M" name="genero" id="genero_m" class="form-check-input" @if ($cliente->genero == 'M') checked @endif>
                        <label for="genero_m" class="form-check-label">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" value="F" name="genero" id="genero_f" class="form-check-input" @if($cliente->genero == 'F') checked @endif>
                        <label for="genero_f" class="form-check-label">Feminino</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" name="telefone" id="telefone" class="form-control phone-ddd-mask" value="{{ $cliente->telefone_formatado }}">
            </div>
        </fieldset>

        <fieldset class="form-group border p-3 mb-3">
            <legend class="w-auto float-none px-2">Endereço</legend>

            <div class="mb-3">
                <label for="cep" class="form-label">CEP:</label>
                <input type="text" name="cep" id="cep" class="form-control cep-mask" value="{{ $endereco->cep_formatado }}">
            </div>
            <div class="mb-3">
                <label for="logradouro" class="form-label">Logradouro:</label>
                <input type="text" name="logradouro" id="logradouro" class="form-control" value="{{ $endereco->logradouro }}">
            </div>
            <div class="mb-3">
                <label for="complemento" class="form-label">Complemento:</label>
                <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $endereco->complemento }}">
            </div>
            <div class="mb-3">
                <label for="bairro" class="form-label">Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $endereco->bairro }}">
            </div>
            <div class="mb-3">
                <label for="localidade" class="form-label">Localidade:</label>
                <input type="text" name="localidade" id="localidade" class="form-control" value="{{ $endereco->localidade }}">
            </div>
            <div class="mb-3">
                <label for="uf" class="form-label">UF:</label>
                <input type="text" name="uf" id="uf" class="form-control" value="{{ $endereco->uf }}">
            </div>
        </fieldset>

        <button type="submit" class="btn btn-primary my-3">Atualizar</button>
    </form>

    <script>
        $(document).ready(function() {
            habilitarMascaras();

            $('input[name=cep]').blur(function() {
                limparCamposEndereco();

                //Nova variável "cep" somente com dígitos
                let cep = $('#cep').val().replace(/\D/g, '');
                let dadosEndereco = "";

                //Verifica se campo cep possui valor informado
                if (cep != "") {
                    //Expressão regular para validar o CEP
                    let validaCep = /^[0-9]{8}$/;

                    if (validaCep.test(cep)) {
                        $.ajax({
                            url: "{{ route('consulta-cep')}}",
                            type: 'POST',
                            data: {
                                cep: cep
                            },
                            beforeSend: function() {
                                $('.textoCarregando').text('Aguarde, Consultando CEP...');
                                $('#loading').show();
                            },
                            success: function(response) {
                                if (response.erro) {
                                    alert(' CEP não encontrado.');
                                    return false
                                }

                                dadosEndereco = response;
                                preencherCamposEndereco(dadosEndereco);
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                console.log(xhr.responseText);
                            },
                            complete: function(response) {
                                $('#loading').hide();
                            }
                        });
                    } else {
                        alert('Por favor digite um CEP válido.')
                    }
                }
            });
        });

        function preencherCamposEndereco(dadosEndereco) {
            const {
                logradouro,
                complemento,
                bairro,
                localidade,
                uf
            } = dadosEndereco;

            $('#logradouro').val(logradouro);
            $('#complemento').val(complemento);
            $('#bairro').val(bairro);
            $('#localidade').val(localidade);
            $('#uf').val(uf);
        }

        function limparCamposEndereco() {
            $('#logradouro').val('');
            $('#complemento').val('');
            $('#bairro').val('');
            $('#localidade').val('');
            $('#uf').val('');
        }
    </script>

</x-layout>