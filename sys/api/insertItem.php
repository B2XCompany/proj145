<?php
include "../conexao.php";

justLog($__EMAIL__);

# pegar a requisição em json
$request = file_get_contents('php://input');
$json = json_decode($request);

$nome       = scapeString($__CONEXAO__, $json->nome);
$plaqueta   = scapeString($__CONEXAO__, $json->plaqueta);
$entidade   = scapeString($__CONEXAO__, $json->entidade);
$setor      = scapeString($__CONEXAO__, $json->setor);
$filial     = 2061;
$local      = "Centro Logístico";
$descricao  = scapeString($__CONEXAO__, $json->descricao);
$imobilizado = scapeString($__CONEXAO__, $json->imobilizado);
$quantidade = scapeString($__CONEXAO__, $json->quantidade);
# falta imagem -------------------------------------------------------

checkMissing([
    $nome,
    $plaqueta,
    $setor,
    $filial,
    $local,
    $descricao,
    $imobilizado,
    $quantidade
]);

if($imobilizado && $entidade==''){
    endCode('Entidade não pode estar vazia quando item está imobilizado.', false);
}

# checar se existe já algum item igual no banco de dados
$query = mysqli_query($__CONEXAO__, "select id from produtos where plaqueta='$plaqueta'");

# chamando função do sys/conexao.php, se a quantidade for maior que zero significa que existe, logo, não pode ser cadastrado
existsQuery($__CONEXAO__, $query, 'Já existe um produto com essa identificação.', false);

# inserindo no banco de dados o item com as especificações
mysqli_query($__CONEXAO__, "insert into produtos (nome, plaqueta, entidade, setor, local, filial, descricao, imobilizado, quantidade) values ('$nome', '$plaqueta', '$entidade', '$setor', '$local', '$filial', '$descricao', '$imobilizado', '$quantidade')");

endCode("Produto registrado!");