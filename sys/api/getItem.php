<?php
include "../conexao.php";

justLog($__EMAIL__);

# pegar a requisição em json
$request = file_get_contents('php://input');
$json = json_decode($request);

$id = scapeString($__CONEXAO__, $json->id);

checkMissing([$id]);

# pegar os dados do produto
$query = mysqli_query($__CONEXAO__, "select * from produtos where id='$id'");

# apesar de ser improvável chegar um id inexistente no backend é melhor previnir 
# fazendo essa checagem do que ficar com erros
if(mysqli_num_rows($query) == 0){
    endCode("Não existe nenhum produto com esse id", false);
}

$dados      = mysqli_fetch_assoc($query);
$nome       = $dados['nome'];
$plaqueta   = $dados['plaqueta'];
$entidade   = $dados['entidade'];
$especie    = $dados['especie'];

# criando um array objeto para facilitar a pegada dos dados no frontend
$data = array(
    "id"            => $id,
    "nome"          => $nome,
    "plaqueta"      => $plaqueta,
    "entidade"      => $entidade,
    "especie"       => $especie
);

endCode($data, true);