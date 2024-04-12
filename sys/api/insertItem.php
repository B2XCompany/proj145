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
$lote       = scapeString($__CONEXAO__, $json->lote);
$setor      = scapeString($__CONEXAO__, $json->setor);
$descricao  = scapeString($__CONEXAO__, $json->descricao);
$imobilizado = scapeString($__CONEXAO__, $json->imobilizado);
$quantidade = scapeString($__CONEXAO__, $json->quantidade);
# falta imagem -------------------------------------------------------

checkMissing([
    $nome,
    $plaqueta,
    $entidade,
    $especie,
    $lote,
    $descricao,
    $imobilizado,
    $quantidade
]);

# checar se existe já algum item igual no banco de dados
$checkQuery = $imobilizado ? "plaqueta='$plaqueta'" : "lote='$lote'";
$query = mysqli_query($__CONEXAO__, "select id from produtos where $checkQuery");

# chamando função do sys/conexao.php, se a quantidade for maior que zero significa que existe, logo, não pode ser cadastrado
existsQuery($__CONEXAO__, $query, 'Já existe um produto com essa identificação.', false);

# inserindo no banco de dados o item com as especificações
mysqli_query($__CONEXAO__, "insert into produtos (nome, plaqueta, entidade, especie, lote, descricao, imobilizado, quantidade) values ('$nome', '$plaqueta', '$entidade', $especie', '$lote', '$descricao', '$imobilizado', '$quantidade')");

endCode("Produto registrado!");