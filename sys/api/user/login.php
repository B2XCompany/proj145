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

# checar se não possui item na query de cima, se não existir, logo, não existe usuário com os dados enviados
if(mysqli_num_rows($query) == 0){
    endCode("Dados incorretos.", false);
}

# salvar os dados na sessão do usuário para ele se manter logado
$_SESSION["email"] = $email;
$_SESSION["password"] = $senha;

endCode("Sucesso!", true);