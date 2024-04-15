<?php
include "../../conexao.php";

cantLog($__EMAIL__);

# pegar a requisição em json
$request = file_get_contents('php://input');
$json = json_decode($request);

$nome   = scapeString($__CONEXAO__, $json->nome);
$email  = scapeString($__CONEXAO__, $json->email);
$senha  = scapeString($__CONEXAO__, $json->senha);

checkMissing([
    $nome,
    $email,
    $senha
]);

# criptografia simples
$senha = md5($senha);

# pegar todos usuários com email no banco de dados
$query = mysqli_query($__CONEXAO__, "select id from usuarios where email='$email'");
$query2 = mysqli_query($__CONEXAO__, "select id from filaespera where email='$email'");

# chamando função do sys/conexao.php, se a quantidade for maior que zero significa que existe, logo, não pode ser cadastrado
existsQuery($__CONEXAO__, $query, "Já existe um usuário com este email", false);
existsQuery($__CONEXAO__, $query2, "Já existe um usuário na fila de espera com este email", false);

# cadastrando usuário no banco de dados
mysqli_query($__CONEXAO__, "insert into filaespera (nome, email, senha) values ('$nome', '$email', '$senha')");

endCode("Usuário enviado para ser aprovado!", true);