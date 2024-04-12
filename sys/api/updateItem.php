<?php
include "../conexao.php";

justLog($__EMAIL__);

# pegar a requisição em json
$request = file_get_contents('php://input');
$json = json_decode($request);

$id         = scapeString($__CONEXAO__, $json->id)
$nome       = scapeString($__CONEXAO__, $json->nome);
$plaqueta   = scapeString($__CONEXAO__, $json->plaqueta);
$entidade   = scapeString($__CONEXAO__, $json->entidade);
$especie    = scapeString($__CONEXAO__, $json->especie);

checkMissing([
    $id,
    $nome,
    $plaqueta,
    $entidade,
    $especie,
]);

# atualizando o banco de dados com os dados novos
mysqli_query($__CONEXAO__, "update produtos set nome='$nome', plaqueta='$plaqueta', entidade='$entidade', especie='$especie' where id='$id'");

endCode("Produto atualizado!");