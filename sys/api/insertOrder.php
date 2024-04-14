<?php
include "../conexao.php";

justLog($__EMAIL__, $__TYPE__, 0);


# pegar a requisição em json
$request = file_get_contents('php://input');
$json = json_decode($request);

$cliente        = scapeString($__CONEXAO__, $json->cliente);
$setor          = scapeString($__CONEXAO__, $json->setor);
$local          = scapeString($__CONEXAO__, $json->local);
$data           = scapeString($__CONEXAO__, $json->data);
$itens          = scapeString($__CONEXAO__, $json->itens);

checkMissing([
    $cliente,
    $setor,
    $local,
    $data,
    $itens
]);

# inserindo no banco de dados o item com as especificações
mysqli_query($__CONEXAO__, "insert into pedidos (cliente, setor, local, data, itens) values ('$cliente', '$setor', '$local', '$data', '$itens')");

endCode("Pedido registrado!");