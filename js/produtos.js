import {items} from "./items.js";

console.log(items)
// criando classe genérica para produto
class Produtos{
    // vai ser executado quando a classe for iniciada
    constructor(){
        this.data = []
        this.filterData = ''
        getAllItems()
    }

    static getAllItems(){
        let url = 'sys/api/getData.php?setor=' + this.filterData;
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
            this.createItemsDiv(this.data)
        })
    }

    // função para criar os elementos da tabela
    static createItemsDiv(data){
        for(let item of data){
            // criar linha
            let div = document.createElement('div');
            for(let value of Object.values(item)){
                // criar celula
                let div2 = document.createElement('div');
                div2.innerText = value;
                tr.append(td);
            }
            tabelaProdutos.append(div);
        }
        return; // criar lista de itens
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