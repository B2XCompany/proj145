<?
include "../conexao.php";
justLog($__EMAIL__, $__TYPE__, 1);


# pegar todos usuarios na fila de espera do banco de dados
$query = mysqli_query($__CONEXAO__, "select nome,email from filaespera");

# criar um array vazio onde vai ser armazenado os itens pegos
$data = array();

# criar um loop pela query para poder pegar todos dados
while($dados = mysqli_fetch_array($query)){
    $nome   = $dados['nome'];
    $email  = $dados['email'];

    # criando um array no formato objeto para acessar mais facilmente no front end
    $array = array(
        "nome"  => $nome,
        "email" => $email
    );
    
    # inserindo esse array objeto dentro do array maior (line:12)
    array_push($data, $array);
}

endCode($data, true);