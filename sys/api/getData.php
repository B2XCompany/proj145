<?php
include "../conexao.php";

justLog($__EMAIL__);

$setor = $_GET['setor'];

$filter = "";

if($setor){
    $filter = "where setor='$setor'";
}

# pegar todos produtos do banco de dados com um filtro se o setor foi definido
$query = mysqli_query($__CONEXAO__, "select * from produtos $filter");

# criar um array vazio onde vai ser armazenado os itens pegos
$data = array();

# criar um loop pela query para poder pegar todos dados
while($dados = mysqli_fetch_array($query)){
    $id             = $dados['id'];
    $nome           = $dados['nome'];
    $plaqueta       = $dados['plaqueta'];
    $entidade       = $dados['entidade'];
    $especie        = $dados['especie'];
    $lote           = $dados['lote'];
    $setor          = $dados['setor'];
    $descricao      = $dados['descricao'];
    $imobilizado    = $dados['imobilizado'];
    $quantidade     = $dados['quantidade'];

    # criando um array no formato objeto para acessar mais facilmente no front end
    $array = array(
        "id"            => $id,
        "nome"          => $nome,
        "plaqueta"      => $plaqueta,
        "entidade"      => $entidade,
        "especie"       => $especie,
        "lote"          => $lote,
        "setor"         => $setor,
        "descricao"     => $descricao,
        "imobilizado"   => $imobilizado,
        "quantidade"    => $quantidade
    );
    
    # inserindo esse array objeto dentro do array maior (line:10)
    array_push($data, $array);
}

endCode($data, true);