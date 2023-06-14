<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar cliente</title>
</head>

<body>

    <!-- <a href="{{ route('cliente.destroy', $cliente->id) }}" onclick="event.preventDefault(); if(confirm('Deseja excluir este cliente?')) document.getElementById('delete-form').submit();"></a> -->

    <form id="delete-form" action="{{ route('cliente.destroy', $cliente->id) }}" method="post" onsubmit="return confirm('Deseja excluir este cliente?');">
        @csrf
        @method('DELETE')

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $cliente->nome }}">
        </div>

        <button type="submit">Excluir</button>
    </form>

</body>

</html>