<?php
// Inicia uma nova sessão ou resume a sessão existente
session_start();

// Define o fuso horário padrão usado por todas as funções de data/hora em um script
date_default_timezone_set('America/Sao_Paulo');

// Define o tipo de conteúdo do cabeçalho para HTML com codificação UTF-8
header('Content-Type: text/html; charset=utf-8');

// SERVER
// Pega o método da requisição HTTP
$__METHOD__     = $_SERVER["REQUEST_METHOD"];

// Pega o nome do host sob o qual o script atual está sendo executado
$__URL__        = $_SERVER["HTTP_HOST"];

// Define a URL base do site
$__HOST__   = $_SERVER['HTTP_HOST'];
$__WEB__    = $_SERVER['REQUEST_SCHEME'] . "://" . $__HOST__;

// Conecta ao banco de dados MySQL
$__CONEXAO__ = mysqli_connect(
    "localhost",
    "root",
    "Bancodedados",
    "teste"
) or die ("Atualize a página e tente novamente!");

// Define os cabeçalhos de controle de acesso
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

// USER 
// Inicializa as variáveis de email e senha
$__EMAIL__ = "";
if(isset($_SESSION["email"])){
    $__EMAIL__ = $_SESSION["email"];
}

$__PASSWORD__ = "";
if(isset($_SESSION["password"])){
    $__EMAIL__ = $_SESSION["password"];
}

// Consulta o banco de dados para verificar se o usuário existe
$_query_ = mysqli_query($__CONEXAO__, "select * from users where email='$__EMAIL__' and senha='$__PASSWORD__'");

// Se o usuário não existir, destrói a sessão e inicia uma nova
if(mysqli_num_rows($_query_) < 1){
    session_destroy();
    session_start();

    if(isset($_SESSION["email"])){
        $__EMAIL__ = $_SESSION["email"];
    }
    if(isset($_SESSION["password"])){
        $__EMAIL__ = $_SESSION["password"];
    }
} else {
    // Se o usuário existir, pega os dados do usuário
    $__ASSOC__  = mysqli_fetch_assoc($_query_);
    $__ID__     = $__ASSOC__['id'];
    $__EMAIL__  = $__ASSOC__['email'];
}

// DATA
// Pega o timestamp atual
$__TIME__ = time();

// FUNÇÕES
// Funções auxiliares para manipulação de dados, validação, autenticação, etc.
// Função para finalizar o script e retornar uma mensagem e um status em formato JSON
function endCode($msg, $status){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array("mensagem"=>$msg, "response"=>$status));
    exit;
}

// Função para verificar se algum dado está faltando no array fornecido
function checkMissing($array){
    for($i = 0; $i < count($array); $i++){
        $item = $array[$i];
        if(!$item or $item == "" or $item == " "){
            endCode("Algum dado está faltando. #$i", false);
        }
    }
}

// Função para redirecionar o usuário para a URL principal se ele não estiver logado
function cantLog($__EMAIL__){
    if($__EMAIL__){
        header("Location: $__URL__");
        exit;
    }
}

// Função para finalizar o script se o usuário não estiver logado
function justLog($__EMAIL__){
    if(!$__EMAIL__){
        endCode("Sem permissão", false);
        exit;
    }
}

// Função para escapar caracteres especiais em uma string para uso em uma instrução SQL, levando em conta o conjunto de caracteres atual da conexão
function scapeString($__CONEXAO__, $string){
    $string = mysqli_real_escape_string($__CONEXAO__, $string);
    return $string;
}

// Função para verificar se o usuário já existe no banco de dados
function stopUserExist($__CONEXAO__, $email, $cpf){
    $tryConnect = mysqli_query($__CONEXAO__, "select id from users where email='$email'") or die("erro select");

    if(mysqli_num_rows($tryConnect) > 0){
        endCode("Email já está em uso", false);
        exit;
    }

    $tryConnect = mysqli_query($__CONEXAO__, "select id from users where cpf='$cpf'") or die("erro select");

    if(mysqli_num_rows($tryConnect) > 0){
        endCode("CPF já está em uso", false);
        exit;
    }

}

// Função para verificar se o usuário não existe no banco de dados
function stopUserExistnt($__CONEXAO__, $string){
    $tryConnect = mysqli_query($__CONEXAO__, "select * from users where email='$string'") or die("erro select");

    if(mysqli_num_rows($tryConnect) < 1){
        return true;
    }
}

// Função para converter o timestamp em um formato de hora
function converterHora($time){
    $time = $time;
    $time = date("H:i", ($time / 1000 + 10800 ));//10800 = +3h timezone
    return $time;
}


function existsQuery($__CONEXAO__, $query, $string, $bool){
    if($bool){
        if(mysqli_num_rows($query) < 1){
            endCode($string, false);
        }
    } else {
        if(mysqli_num_rows($query) > 0){
            endCode($string, false);
        }
    }
}