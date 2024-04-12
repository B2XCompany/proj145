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
    <h1>Cadastrar</h1>
    <form action="javascript:void(0)">
        <input type="text" id="email" placeholder="Email para cadastro">
        <input type="password" id="senha" placeholder="Senha">
        <button onclick="logarUser()">Cadastrar</button>
    </form>
    <a href="./logar.php">Logar</a>

    <script>
        const logarUser = () => {
            let data = {
                email: email.value,
                senha: senha.value
            }
            fetch("./sys/api/user/register.php",{
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
</body>
</html>