<?php
include "sys/conexao.php";
cantLog($__EMAIL__);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/func.js"></script>
    <title>Logar</title>
</head>
<body>
    <h1>Cadastrar</h1>
    <form action="javascript:void(0)">
        <input type="text" id="nome" placeholder="Nome para cadastro">
        <input type="text" id="email" placeholder="Email para cadastro">
        <input type="password" id="senha" placeholder="Senha">
        <button onclick="addNewData('user/register.php', {nome: nome.value, email: email.value, senha: senha.value})">Cadastrar</button>
    </form>
    <a href="./logar.php">Logar</a>
</body>
</html>