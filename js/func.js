setoresArray = ['Mesas e Escrivaninhas', 'Cadeiras Giratórias e Fixas', 'Armários e Balcões', 'Carteiras Cadeiras Escola', 'Equipamentos Cursos SENAI', 'SESI academias', 'Equipamentos GEFAN', 'Equipamentos de TI', 'Veículos', 'Educação 4.0', 'Ar Condicionado'];


isActive = false;
function addNewData(local, data){
    if(isActive) return;
    isActive = true;
    fetch(`./sys/api/${local}`,{
        method: "POST",
        body: JSON.stringify(data)
    })
    .then(e=>e.json())
    .then((e)=>{
        console.log(e)
    })
}

searchBar.addEventListener('keyup', ()=>{
    let val = searchBar.value.toString();
    produtos.createItemsDiv(produtos.data, produtos.filter, val);
})