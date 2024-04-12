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
</head>
<body>
    <h1>Logar</h1>
    <form action="javascript:void(0)">
        <input type="text" id="email" placeholder="Digite seu email...">
        <input type="password" id="senha" placeholder="Senha">
        <button onclick="logarUser()">Entrar</button>
    </form>

    <a href="./registrar.php">Registrar</a>
    <script>
        // função que envia os dados para a API criada no back 
        const logarUser = () => {
            // Dados que vamos passar em um objeto
            let data = {
                email: email.value,
                senha: senha.value
            }

            // enviar a requisição com os dados anteriores
            fetch("./sys/api/user/login.php",{
                method: "POST",
                body: JSON.stringify(data)
            })
            .then(e=>e.json())
            .then(e=>{
                if(e.response){
                    window.location = "./";
                }
            })
            .catch(e=>{
                console.log("erro")
            })
        }
    </script>
    <script type='module' src="./js/produtos.js"></script>
</body>
</html>