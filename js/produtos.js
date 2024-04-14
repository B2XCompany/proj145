import {items} from "./items.js";

console.log(items)
// criando classe genérica para produto
class Produtos{
    // vai ser executado quando a classe for iniciada
    constructor(){
        this.data = []
        this.filter = false
        getAllItems()
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
            this.createHeader() // falta fazer -> vai criar os filtros
            this.createItemsDiv(this.data, this.filter, false)
        })
    }

    // função para criar os elementos da tabela
    static createItemsDiv(data, filter, search){
        tabelaProdutos.innerHTML = '';
        console.log(data);
        for(let item of data){
            if(item.setor != filter && filter){
                continue
            }
            if(item.nome != search && search){
                continue
            }
            // criar div principal
            let div = document.createElement('div');
            for(let [key, value] of Object.entries(item)){
                if(['id', 'imobilizado', 'plaqueta'].includes(key)){
                    continue
                }
                console.log(key);
                
                let divInterna = document.createElement('div');

                if(key == 'nome'){
                    let title = document.createElement('p');
                    title.classList.add('produto-titulo');
                    title.innerText = value;
                    divInterna.append(title);

                } else if(key == 'imagem'){
                    let divImg = document.createElement('div');

                    let img = document.createElement('img');
                    img.classList.add('produto-img');
                    img.src = 'imagens/' + value

                    divImg.append(img);
                    divInterna.append(divImg);

                } else if(key == 'entidade'){
                    let p = document.createElement('p');
                    p.classList.add('produto-identificador');
                    p.innerText = value + ' ' + item.plaqueta;

                    divInterna.append(p);

                } else if(key == 'descricao'){
                    let p = document.createElement('p');
                    p.classList.add('produto-descricao');
                    p.innerText = value

                    divInterna.append(p);

                } else { // quantidade
                    let p = document.createElement('p');
                    p.classList.add('produto-quantidade');
                    p.innerText = 'Disponível no estoque - ' + value;

                    divInterna.append(p);
                }
                div.append(divInterna);
            }
            tabelaProdutos.append(div);
        }
    }
}