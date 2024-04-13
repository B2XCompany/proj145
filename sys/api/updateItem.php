<?php
include "../conexao.php";

justLog($__EMAIL__);

# pegar a requisição em json
$request = file_get_contents('php://input');
$json = json_decode($request);

$nome       = scapeString($__CONEXAO__, $json->nome);
$plaqueta   = scapeString($__CONEXAO__, $json->plaqueta);
$entidade   = scapeString($__CONEXAO__, $json->entidade);
$especie    = scapeString($__CONEXAO__, $json->especie);
$setor      = scapeString($__CONEXAO__, $json->setor);
$local      = scapeString($__CONEXAO__, $json->local);
$descricao  = scapeString($__CONEXAO__, $json->descricao);
$imobilizado = scapeString($__CONEXAO__, $json->imobilizado);
$quantidade = scapeString($__CONEXAO__, $json->quantidade);
# falta imagem -------------------------------------------------------

checkMissing([
    $nome,
    $plaqueta,
    $entidade,
    $especie,
    $setor,
    $local,
    $descricao,
    $imobilizado,
    $quantidade
]);

$query = mysqli_query($__CONEXAO__, "select id from produtos where plaqueta='$plaqueta'");

# chamando função do sys/conexao.php, se a quantidade for maior que zero significa que existe, logo, não pode ser atualizado
existsQuery($__CONEXAO__, $query, 'Não existe um produto com essa identificação.', true);

# atualizando o banco de dados com os dados novos
mysqli_query($__CONEXAO__, "update produtos set nome='$nome', plaqueta='$plaqueta', entidade='$entidade', especie='$especie', setor='$setor', local='$local', descricao='$descricao', imobilizado='$imobilizado', quantidade='$quantidade' where id='$id'");

endCode("Produto atualizado!");