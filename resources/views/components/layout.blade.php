<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} - CRUD Clientes</title>
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
</head>

<body>
    <div class="container">
        <h1>{{ $title }}</h1>
        <hr>

        {{ $slot }}
    </div>

    <script>
        // Necessário para realizar requisições AJAX
        // X-CSRF-TOKEN indica que o token enviado é o mesmo que está armazenado na sessão no servidor
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>

</html>