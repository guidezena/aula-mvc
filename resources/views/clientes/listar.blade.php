<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <tr>
        <th>
            Nome
        </th>
        <th>
            Endereço
        </th>
    </tr>
    @foreach($clientes as $cliente)
    <tr>
        <td>
        {{$clientes->nome}}
        </td>
        <td>
        {{$clientes->endereco}}
        </td>
    </tr>
    @endforeach
</body>

</html>