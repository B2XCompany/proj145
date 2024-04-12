<?php
include "sys/conexao.php";

if(!$__EMAIL__){
    header("Location: ./logar.php");    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="adicionarProdutos"></div>
    <div id="tabelaProdutos"></div>
</body>
</html>