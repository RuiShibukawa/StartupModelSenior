const botaoIncluir = document.getElementById("incluir-item-solicitarItens");

botaoIncluir.addEventListener("click", (evento)=>{
    evento.preventDefault();

    const data = document.getElementById("data-solicitarItens").getAttribute("value");
    const cracha = document.getElementById("cracha-solicitarItens").getAttribute("value");
    const categoria = document.getElementById("select-categoria-solicitarItens");
    const categoriaId = categoria.value;
    const categoriaNome = categoria.options[categoria.selectedIndex].text;
    const item = document.getElementById("select-item-solicitarItens");
    const itemId = item.value;
    const itemDesc = item.options[item.selectedIndex].text;
    const unidadeMedida = item.options[item.selectedIndex].getAttribute("data-unidade");
    const quantidade = document.getElementById("quantidade-item").value;
    const turma = document.getElementById("turma-item").value;

    if(!categoriaId){alert("Você deve escolher uma categoria..."); return;}
    if(!itemId){alert("Você deve escolher um item..."); return;}
    if(quantidade<=0 || isNaN(quantidade)){alert("Você deve informar a quantidade desejada..."); return;}

    const listaDeItens = document.getElementById("tabela-de-itens");
    const linhaItem = document.createElement("tr");
    linhaItem.innerHTML= `
        <td>
            ${data}
            <input type="hidden" name="data-inclusao" value="${data}">
        </td>
        <td>
            ${cracha}
            <input type="hidden" name="cracha-inclusao" value="${cracha}">
        </td>
        <td>
            ${itemDesc}
            <input type="hidden" name="itemId-inclusao" value="${itemId}">
            <input type="hidden" name="item-inclusao" value="${itemDesc}">
        </td>
        <td>
            ${quantidade}
            <input type="hidden" name="quantidade-inclusao" value="${quantidade}">
        </td>
        <td>
            ${unidadeMedida}
            <input type="hidden" name="unidadeMedida-inclusao" value="${unidadeMedida}">
        </td>
        <td>
            ${turma}
            <input type="hidden" name="turma-inclusao" value="${turma}">
        </td>
        <td>
            <button type="button" class="btn-del">Excluir</button>
        </td>

    `;
    listaDeItens.appendChild(linhaItem);
})

document.getElementById("tabela-de-itens").addEventListener("click", (evento)=>{
    if(evento.target.classList.contains("btn-del")){
        evento.preventDefault();
        if(!confirm("Tem ceteza que deseja excluir da lista?")){
            return;
        }
        const linha = evento.target.closest("tr");
        linha.remove();
    }    
})