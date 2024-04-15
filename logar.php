<?php
include "sys/conexao.php";
cantLog($__EMAIL__);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logar</title>
    <script src="js/func.js"></script>
</head>
<body>
    <h1>Logar</h1>
    <form action="javascript:void(0)">
        <input type="text" id="email" placeholder="Digite seu email...">
        <input type="password" id="senha" placeholder="Senha">
        <button onclick="addNewData('user/login.php', {email: email.value, senha: senha.value})">Entrar</button>
    </form>

    <a href="./registrar.php">Registrar</a>
</body>
</html>