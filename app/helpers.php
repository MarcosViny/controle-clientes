<?php

/**
 * Limpa os caracteres não numéricos de um CPF ou CNPJ.
 *
 * @param string $valor O valor do CPF ou CNPJ a ser limpo.
 * @return string O CPF ou CNPJ sem caracteres não numéricos.
 */
function limpa_cpf_cnpj($valor)
{
    $valor = trim($valor);
    $valor = str_replace(array('.', '-', '/'), "", $valor);
    return $valor;
}

/**
 * Limpa os caracteres não numéricos de um número de telefone.
 *
 * @param string $telefone O número de telefone a ser limpo.
 * @return string O número de telefone sem caracteres não numéricos.
 */
function limpa_telefone($telefone)
{
    return preg_replace('/[^0-9]/', '', $telefone);
}

/**
 * Formata um CEP com a máscara "#####-###".
 *
 * @param string $cep O CEP a ser formatado.
 * @return string O CEP formatado.
 */
function formatarCep($cep)
{
    $cep = preg_replace('/[^0-9]/', '', $cep); // Remove todos os caracteres não numéricos
    $mascara = '#####-###'; // Máscara do CEP
    $formatado = '';

    $indice = 0;
    for ($i = 0; $i < strlen($mascara); $i++) {
        if ($mascara[$i] === '#') {
            if (isset($cep[$indice])) {
                $formatado .= $cep[$indice];
                $indice++;
            }
        } else {
            $formatado .= $mascara[$i];
        }
    }

    return $formatado;
}

/**
 * Formata um número de telefone com a máscara "(##) #####-####".
 *
 * @param string $telefone O número de telefone a ser formatado.
 * @return string O número de telefone formatado.
 */
function formatarTelefone($telefone)
{
    $telefone = preg_replace('/[^0-9]/', '', $telefone); // Remove todos os caracteres não numéricos

    if (strlen($telefone) === 11) {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone); // Formato: (99) 99999-9999
    }

    return $telefone; // Retorna o valor original caso não seja um número de telefone celular válido
}
