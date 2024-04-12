<?php
include "../../conexao.php";

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

# pegar todos usuários com email no banco de dados
$query = mysqli_query($__CONEXAO__, "select id from users where email='$email'");

# se for maior que zero significa que existe, logo, não pode ter outro
if(mysqli_num_rows($query) > 0){
    endCode("Já existe um usuário com este email", false);
}

# cadastrando usuário no banco de dados
mysqli_query($__CONEXAO__, "insert into users (email, senha) values ('$email', '$senha')");

# salvar os dados na sessão do usuário para ele se manter logado
$_SESSION["email"] = $email;
$_SESSION["password"] = $senha;

endCode("Sucesso!", true);