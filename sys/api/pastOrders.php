<?php
include "../conexao.php";

justLog($__EMAIL__, $__TYPE__, 1);


# pegar pedidos aceitos ou rejeitados
$query = mysqli_query($__CONEXAO__, "select * from pedidos where status in (2,3)");

# criar um array vazio onde vai ser armazenado os itens pegos
$data = array();

# criar um loop pela query para poder pegar todos dados
while($dados = mysqli_fetch_array($query)){
    $id             = $dados['id'];
    $cliente        = $dados['cliente'];
    $data           = $dados['data'];
    $itens          = $dados['itens'];
    $status         = $dados['status'];

    $queryC = mysqli_query($__CONEXAO__, "select nome, email from usuarios where id='$cliente'");
    $dadosC = mysqli_fetch_assoc($queryC);
    $nomeC  = $dadosC['nome'];
    $emailC  = $dadosC['email'];

    $itens = substr($itens, 1);
    $itens = strlen($itens) > 0 ? array_map('intval', explode(',', $itens)) : "";
    $itens = implode("','", $itens);

    $arrItens = array();

    $queryI = mysqli_query($__CONEXAO__, "select nome from produtos where plaqueta in ('".$itens."')") or die ("asd");

    while($dadosI = mysqli_fetch_array($queryI)){
        $nomeI = $dadosI['nome'];
        array_push($arrItens, $nomeI);
    }


    # criando um array no formato objeto para acessar mais facilmente no front end
    $array = array(
        "id"        => $id,
        "cliente"   => $nomeC,
        "email"     => $emailC,
        "data"      => $data,
        "itens"     => $arrItens,
        "status"    => $status
    );
    
    # inserindo esse array objeto dentro do array maior (line:10)
    array_push($data, $array);
}

endCode($data, true);