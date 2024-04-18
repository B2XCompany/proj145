console.log('funcionando!');

async function usuariosTake(){
    let url = 'sys/api/user/getEspera';
    return fetch(url)
    .then(e=>e.json())
    .then(e=>{
        for(i of e){
            let div = document.createElement("div");
            div.classList.add('usuarios-div');

            let nome = document.createElement('p');
            nome.innerText = 'Nome: ' + i.nome;

            let email = document.createElement('p');
            email.innerText = 'Email: ' + i.email;

            let div2 = document.createElement('div');
            div2.classList.add('usuarios-div-bt');

            let approveBt = document.createElement('button');
            approveBt.onclick = addNewData('user/approveAccount', {id: i.id});
            approveBt.classList.add('usuarios-approve-bt');
            approveBt.innerText = 'Aprovar';

            let rejectBt = document.createElement('button');
            rejectBt.onclick = addNewData('user/rejectAccount', {id: i.id});
            rejectBt.classList.add('usuarios-reject-bt');
            rejectBt.innerText = 'Rejeitar';

            div.append(nome);
            div.append(email);
            div2.append(approveBt);
            div2.append(rejectBt);
            div.append(div2);

            aprovarUsuarios.append(div);
        }
    })
}


async function usuariosTake(){
    let url = 'sys/api/getOrders';
    return fetch(url)
    .then(e=>e.json())
    .then(e=>{
        for(i of e){
            let div = document.createElement("div");
            div.classList.add('pedidos-div');

            let nome = document.createElement('p');
            nome.classList.add('produtos-cliente');
            nome.innerText = 'Cliente: ' + i.cliente;

            let filial = document.createElement('p');
            filial.innerText = i.filial;

            let local = document.createElement('p');
            local.innerText = i.local;

            let data = document.createElement('p');
            data.innerText = i.data;

            let status = document.createElement('p');
            status.innerText = 'Status: ' + status;

            let itensDiv = document.createElement('div');

            let itensTitle = document.createElement('p');
            itensTitle.innerText = 'Itens do pedido';
            itensTitle.classList.add('pedidos-itens-title');

            itemDiv = document.createElement('div');
            itemDiv.classList.add('pedidos-itens-item');

            i.itens.map(item => ()=>{
                let p = document.createElement("p");
                p.innerText = item
                itemDiv.append(p);
            })

            let div2 = document.createElement('div');
            div2.classList.add('usuarios-div-bt');

            let approveBt = document.createElement('button');
            approveBt.onclick = addNewData('updateOrder', {id: i.id, status: i.status + 1});
            approveBt.classList.add('pedidos-approve-bt');
            approveBt.innerText = i.status == 0 ? 'Aprovar' : 'Enviar';

            let rejectBt = document.createElement('button');
            rejectBt.onclick = addNewData('updateOrder', {id: i.id, status: 3});
            rejectBt.classList.add('pedidos-reject-bt');
            rejectBt.innerText = 'Rejeitar';

            div.append(nome);
            div.append(filial);
            div.append(local);
            div.append(data);
            div.append(status);
            itensDiv.append(itensTitle);
            itensDiv.append(itemDiv);
            div.append(itensDiv);
            div2.append(approveBt);
            div2.append(rejectBt);
            div.append(div2);
            
            aprovarPedidos.append(div);
        }
    })
}