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

checkMissing([
    $nome,
    $plaqueta,
    $entidade,
    $especie
]);

# checar se existe já algum item igual no banco de dados
$query = mysqli_query($__CONEXAO__, "select id from produtos where "); # terminar de escrever

# se a quantidade for maior que zero significa que existe, logo, não pode ser cadastrado
if(mysqli_num_rows($query) > 0){
    endCode("Já existe um item com essas especificações.", false);
}

# inserindo no banco de dados o item com as especificações
mysqli_query($__CONEXAO__, "insert into produtos (nome, plaqueta, entidade, especie) values ('$nome', '$plaqueta', '$entidade', $especie')");

endCode("Produto registrado!");