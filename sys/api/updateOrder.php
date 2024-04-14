<?php
include "../conexao.php";

justLog($__EMAIL__, $__TYPE__, 1);


# pegar a requisição em json
$request = file_get_contents('php://input');
$json = json_decode($request);

$id       = scapeString($__CONEXAO__, $json->id);
$status   = scapeString($__CONEXAO__, $json->status);

checkMissing([
    $id,
    $status
]);

$query = mysqli_query($__CONEXAO__, "select id from pedidos where id='$id'");

# chamando função do sys/conexao.php, se a quantidade for maior que zero significa que existe, logo, não pode ser atualizado
existsQuery($__CONEXAO__, $query, 'Não existe um pedido com essa identificação.', true);

# atualizando o banco de dados com os dados novos
mysqli_query($__CONEXAO__, "update pedidos set status='$status' where id='$id'");

endCode("Produto atualizado!");