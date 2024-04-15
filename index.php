<?php
include "sys/conexao.php";

if(!isset($_SESSION['email'])){
    header("Location: ./logar.php");    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produtos</title>
    <?php if(requireLevel($__TYPE__, 1)){ ?><script src="js/getAdm.js"></script><?php } ?>
    <script src='js/produtos.js'></script>
    <script>const produtos = new Produtos(); </script>
    <script src="js/func.js"></script>
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <?php if(requireLevel($__TYPE__, 1)){ ?>
    <div id="top">
        <div id="adicionarProdutos">
            <form action="javascript:void(0)">
                <div class="input-div">
                    <p class="input-p">Nome</p>
                    <input type="text" id="nomereg" placeholder="Ex: Cadeira Giratória Ergonômica">
                </div>
                <div class="input-div">
                    <p class="input-p">Plaqueta / Lote</p>
                    <input type="text" id="plaquetareg" placeholder="Ex: 123456">
                </div>
                <div class="input-div">
                    <p class="input-p">Imobilizado</p>
                    <label class='toggle' for='imobilizadoreg'></label>
                    <input type="checkbox" id="imobilizadoreg">
                </div>
                <div class="input-div">
                    <p class="input-p">Entidade</p>
                    <select id='entidadereg'>
                        <option value=''>Nenhuma</option>
                        <option value='iel'>IEL</option>
                        <option value='sesi'>SESI</option>
                        <option value='senai'>SENAI</option>
                        <option value='fiesc'>FIESC</option>
                    </select>
                </div>
                <div class="input-div">
                    <p class="input-p">Setor</p>
                    <select id="setorreg"></select>
                </div>
                <div class="input-div">
                    <p class="input-p">Descrição</p>
                    <input type="text" id="descricaoreg" placeholder="Ex: Cadeira giratória ergonômica com apoio lombar ajustável.">
                </div>
                <div class="input-div">
                    <p class="input-p">Quantidade</p>
                    <input type="number" id="quantidadereg" placeholder="Ex: 2">
                </div>
                <button onclick="addNewData('insertItem.php', {nome: nomereg.value, plaqueta: plaquetareg.value, imobilizado: imobilizadoreg.value, entidade: entidadereg.value, setor: setorreg.value, descricao: descricaoreg.value, quantidade: quantidadereg.value})">Cadastrar</button>
            </form>
        </div>
        <div id="aprovarUsuarios"></div>
        <div id="aprovarPedidos"></div>
    </div>
    <?php } ?>

    <div id="tabelaProdutos"></div>

    <script>
        if(typeof setorreg !== "undefined"){
            for(i of setoresArray){
                setorreg.innerHTML += `<option value='${i}'>${i}</option>`
            }
        }
    </script>
</body>
</html>