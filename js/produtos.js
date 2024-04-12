import {items} from "./items.js";

console.log(items)
// criando classe genérica para produto
class Produtos{
    // vai ser executado quando a classe for iniciada
    constructor(){
        this.data = []
        getItemData(this.id)
    }

    static getAllItems(){
        let url = 'sys/api/getData.php';
        // enviar requisição para getData.php
        return fetch(url)
        // retornando resposta do getData.php
        .then(e=>e.json())
        .then(e=>{
            if(!e.response){
                newMsg(e);
                return;
            }
            let data = e.mensagem;
            // colocando os dados no objeto this.data
            for(let i of data){
                let obj = {};
                for(let [key, value] of Object.entries(i)){
                    obj[key] = value;
                }
                this.data.push(obj);
            }
            // criar header e depois criar os elementos de dentro da tabela
            this.createHeader(this.data[0])
            .then(this.createItemsDiv(this.data))
        })
    }

    // função para criar os elementos da tabela
    createItemsDiv(data){
        this.createHeader(data[0])
        .then(e=>{
            for(let i of data){
                // criar linha
                let tr = document.createElement('tr');
                for(let value of Object.values(i)){
                    // criar celula
                    let td = document.createElement('td');
                    td.innerText = value;
                    tr.append(td);
                }
                tabelaProdutos.append(tr);
            }
            return; // criar lista de itens
        })
    }

    // 
    createHeader(data){
        let th = document.createElement("th");
        for(let key of Object.keys(i)){
            let td = document.createElement("td");
            td.innerText = key
            th.append(td);
        }
        tabelaProdutos.append(th);
    }

    // declarando função para ser usada nas classes filhas
    getItemData(id){
        return;
    }
    createDiv(data){
        return;
    }
}

class ProdutoDetalhe extends Produtos{
    constructor(id){
        this.id = id
        this.itemData = {}
    }

    getItemData(id){
        let url = 'sys/api/getItem.php';
        // enviar id para getItem.php
        return fetch(url, {
            method: 'POST',
            body: JSON.stringify({"id": id})
        })
        // retornando resposta do getItem.php
        .then(e=>e.json())
        .then(e=>{
            if(!e.response){
                newMsg(e);
                return;
            }
            let data = e.mensagem;
            // colocando os dados no objeto this.itemData
            for(let [key, value] of Object.entries(data)){
                this.itemData[key] = value;
            }
            this.createDiv(this.itemData)
        })
    }
    
    // especificando função para essa classe filho
    createDiv(data){
        return; // criar detalhes
    }
}