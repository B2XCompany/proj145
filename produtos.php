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
    <title>Produtos</title>
    <script src='js/produtos.js'></script>
    <script>const produtos = new Produtos(); </script>
</head>
<body>
    <div id="tabelaProdutos"></div>
</body>
</html>