<?php
include "../conexao.php";

justLog($__EMAIL__, $__TYPE__, 1);


# pegar a requisição em json
$request = file_get_contents('php://input');
$json = json_decode($request);

$id = scapeString($__CONEXAO__, $json->id);

checkMissing([
    $id
]);

// pegando os dados da fila de espera pra posteriormente mandar para os users normais
$query  = mysqli_query($__CONEXAO__, "select nome,senha,email from filaespera where id='$id'");
$dados  = mysqli_fetch_assoc($query);
$nome   = $dados['nome'];
$senha  = $dados['senha'];
$email  = $dados['email'];

# chamando função do sys/conexao.php, se a quantidade for maior que zero significa que existe, logo, não pode ser atualizado
existsQuery($__CONEXAO__, $query, 'Não existe uma conta na fila de espera com esse email.', true);

# tirando o usuario da fila de espera e mandando para os normais
mysqli_query($__CONEXAO__, "insert into usuarios (nome, email, senha) values ('$nome', '$email', '$senha')");
mysqli_query($__CONEXAO__, "delete from listaespera where id='$id'");

endCode("Usuário atualizado!");