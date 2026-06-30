const botaoIncluir = document.getElementById("incluir-item-solicitarItens");

function tratarValor(valor) {
    return String(valor ?? "")
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

if (botaoIncluir) {
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
        const unidadeMedida = item.options[item.selectedIndex].getAttribute("data-unidade") || "";
        const quantidade = document.getElementById("quantidade-item").value;
        const quantidadeValidada = Number(String(quantidade).replace(',', '.'));
        const turma = document.getElementById("turma-item").value;

        if(!categoriaId){alert("Você deve escolher uma categoria..."); return;}
        if(!itemId){alert("Você deve escolher um item..."); return;}
        if(quantidadeValidada<=0 || isNaN(quantidadeValidada)){alert("Você deve informar a quantidade desejada..."); return;}

        const listaDeItens = document.getElementById("tabela-de-itens");
        const linhaItem = document.createElement("tr");
        linhaItem.innerHTML= `
            <td>
                ${tratarValor(data)}
                <input type="hidden" name="data-inclusao[]" value="${tratarValor(data)}">
            </td>
            <td>
                ${tratarValor(cracha)}
                <input type="hidden" name="cracha-inclusao[]" value="${tratarValor(cracha)}">
            </td>
            <td>
                ${tratarValor(itemDesc)}
                <input type="hidden" name="itemId-inclusao[]" value="${tratarValor(itemId)}">
                <input type="hidden" name="item-inclusao[]" value="${tratarValor(itemDesc)}">
            </td>
            <td>
                ${tratarValor(quantidade)}
                <input type="hidden" name="quantidade-inclusao[]" value="${tratarValor(quantidade)}">
            </td>
            <td>
                ${tratarValor(unidadeMedida)}
                <input type="hidden" name="unidadeMedida-inclusao[]" value="${tratarValor(unidadeMedida)}">
            </td>
            <td>
                ${tratarValor(turma)}
                <input type="hidden" name="turma-inclusao[]" value="${tratarValor(turma)}">
            </td>
            <td>
                <button type="button" class="btn-del">Excluir</button>
            </td>

        `;
        listaDeItens.appendChild(linhaItem);
        document.getElementById("turma-item").value = "";
        document.getElementById("quantidade-item").value = "";
        categoria.value = "";
        item.options.length = 1;
    })
}

document.getElementById("tabela-de-itens").addEventListener("click", (evento)=>{
    if(evento.target.classList.contains("btn-del")){
        evento.preventDefault();
        if(!confirm("Tem certeza que deseja excluir da lista?")){
            return;
        }
        const linha = evento.target.closest("tr");
        linha.remove();
    }    
})
