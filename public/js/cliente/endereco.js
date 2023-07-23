function pesquisarCep(cep) {
    let dadosEndereco = "";

    //Verifica se campo cep possui valor informado
    if (cep != "") {
        //Expressão regular para validar o CEP
        let validaCep = /^[0-9]{8}$/;

        if (validaCep.test(cep)) {
            $.ajax({
                url: "/consulta-cep",
                type: 'POST',
                dataType: 'json',
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
}

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