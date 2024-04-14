<?php
include "../conexao.php";

justLog($__EMAIL__, $__TYPE__, 1);


# pegar a requisição em json
$request = file_get_contents('php://input');
$json = json_decode($request);

$email = scapeString($__CONEXAO__, $json->email);

checkMissing([
    $email
]);

$query = mysqli_query($__CONEXAO__, "select nome,senha from filaespera where id='$email'");
$dados = mysqli_fetch_assoc($query);
$nome = $dados['nome'];
$senha = $dados['senha'];

# chamando função do sys/conexao.php, se a quantidade for maior que zero significa que existe, logo, não pode ser atualizado
existsQuery($__CONEXAO__, $query, 'Não existe uma conta na fila de espera com esse email.', true);

# atualizando o banco de dados com os dados novos
mysqli_query($__CONEXAO__, "insert into users (nome, email, senha) values ('$nome', '$email', '$senha')");
mysqli_query($__CONEXAO__, "delete from listaespera where email='$email'");

endCode("Produto atualizado!");