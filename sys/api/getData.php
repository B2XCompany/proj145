<?php
include "../conexao.php";

justLog($__EMAIL__, $__TYPE__, 0);


# pegar todos produtos do banco de dados
$query = mysqli_query($__CONEXAO__, "select * from produtos");

# criar um array vazio onde vai ser armazenado os itens pegos
$data = array();

# criar um loop pela query para poder pegar todos dados
while($dados = mysqli_fetch_array($query)){
    $id             = $dados['id'];
    $nome           = $dados['nome'];
    $plaqueta       = $dados['plaqueta'];
    $entidade       = $dados['entidade'];
    $descricao      = $dados['descricao'];
    $imobilizado    = $dados['imobilizado'];
    $quantidade     = $dados['quantidade'];
    $imagem         = $dados['imagem'];

    # criando um array no formato objeto para acessar mais facilmente no front end
    $array = array(
        "id"            => $id,
        "imobilizado"   => $imobilizado,
        "nome"          => $nome,
        "imagem"        => $imagem
        "entidade"      => $entidade,
        "plaqueta"      => $plaqueta,
        "descricao"     => $descricao,
        "quantidade"    => $quantidade,
    );
    
    # inserindo esse array objeto dentro do array maior (line:10)
    array_push($data, $array);
}

endCode($data, true);