<?php
include "../conexao.php";

justLog($__EMAIL__);

# pegar todos produtos do banco de dados
$query = mysqli_query($__CONEXAO__, "select * from produtos");

# criar um array vazio onde vai ser armazenado os itens pegos
$data = array();

# criar um loop pela query para poder pegar todos dados
while($dados = mysqli_fetch_array($query)){
    $id         = $dados['id'];
    $nome       = $dados['nome'];
    $plaqueta   = $dados['plaqueta'];
    $entidade   = $dados['entidade'];
    $especie    = $dados['especie'];

    # criando um array no formato objeto para acessar mais facilmente no front end
    $array = array(
        "id"            => $id,
        "nome"          => $nome,
        "plaqueta"      => $plaqueta,
        "entidade"      => $entidade,
        "especie"       => $especie
    );
    # inserindo esse array objeto dentro do array maior (line:10)
    array_push($data, $array);
}

endCode($data, true);