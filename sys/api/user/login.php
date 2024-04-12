<?php
include "../../conexao.php";

cantLog($__EMAIL__);

# pegar a requisição em json
$request = file_get_contents('php://input');
$json = json_decode($request);

$email  = scapeString($__CONEXAO__, $json->email);
$senha  = scapeString($__CONEXAO__, $json->senha);

checkMissing([
    $email,
    $senha
]);

# criptografia simples
$senha = md5($senha);

# pegar todos usuários com email e senha no banco de dados
$query = mysqli_query($__CONEXAO__, "select id from users where email='$email' and senha='$senha'");

# chamando função setada no sys/conexao.php para checar se existe algum elemento nessa query
existsQuery($__CONEXAO__, $query, 'Dados incorretos.', true);

# salvar os dados na sessão do usuário para ele se manter logado
$_SESSION["email"] = $email;
$_SESSION["password"] = $senha;

endCode("Sucesso!", true);