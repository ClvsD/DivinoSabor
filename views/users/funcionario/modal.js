function gestao_produtos() {

    location.href = "../../cadastro_produto/index.php";

}

function gestao_clientes() {

    location.href = "../../gestao_clientes_adm/index.php";

}

function gestao_tickets() {

    location.href = "../../gestao_tickets_adm/index.php";

}

function go_to_page(page) {

    if (page == "GestaoProdutos") {
        location.href = "../../views/gestao_produto_adm/index.php";

    } else if (page == "GestaoClientes") {
        location.href = "../../views/gestao_clientes_adm/index.php";

    } else if (page == "GestaoTickets") {
        location.href = "../../views/users/admin/index.php";

    } else if (page == "GestaoFuncionarios") {
        location.href = "../../views/gestao_funcionarios_adm/index.php";

    } else if (page == "Relatorios") {
        location.href = "../../views/relatorio/";

    } else if (page == "NovoTicket") {
        location.href = "../../views/cadastro_ticket/index.php";

    } else if(input == "Logo"){
        location.href = "../../views/login"

    } else {
        alert("Pagina nao encontrada, tente novamente");
    }

}



//---------------------INÍCIO CARRINHO DE COMPRAS-------------------------
if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", iniciar);
} else {
    iniciar();
}

function iniciar() {

    const adicionarProduto = document.getElementsByClassName("select2-results__option");

    for (var i = 0; i < adicionarProduto.length; i++) {

        adicionarProduto[i].addEventListener("click", adicionarProdutoCarrinho);
    }


}

function adicionarProdutoCarrinho(event) {
    const opcao = event.target;
    console.log(opcao);

    let ultimoEspaco = opcao.textContent.lastIndexOf(" ");

    let precoProduto = opcao.textContent.substr(ultimoEspaco + 1);
    let nomeProduto = opcao.textContent.substring(0, opcao.textContent.indexOf(" -"));


    let novoProduto = document.createElement("div");
    novoProduto.classList.add("container_item");

    novoProduto.innerHTML =
        `
    <section class="container_item">
        <DIV class="float-start"> <input class="quantidade_item" type="number"> </DIV>
        <DIV class="float-start"> <input class="nome_item" type="text" disabled title="${nomeProduto}" value="${nomeProduto}"> </DIV>
        <div class="icon_delete_item"> <i class="fa-solid fa-xmark cursor_pointer"></i> </div>
    </section>
    `
    const containerProdutos = document.querySelector("#itens_selecionados_scroll");
    containerProdutos.append(novoProduto);

}

//----------------FIM CARRINHO DE COMPRAS-----------------------------

/* Script para puxar o menu lateral */
MSL = "OFF";
function Exibir_MSL() {

    if (MSL == "OFF") {

        MSL = "ON";
        document.getElementById("menu_sanduiche_left").style.display = "block";
        document.getElementById("black_screen_MSL").style.display = "block";

        setTimeout(function () {
            document.getElementById("menu_sanduiche_left").style.transform = "translateX(0px)";
            document.getElementById("black_screen_MSL").style.opacity = "1";
        }, 100);
    } else if (MSL == "ON") {

        MSL = "OFF";
        document.getElementById("black_screen_MSL").style.opacity = "0";
        document.getElementById("menu_sanduiche_left").style.transform = "translateX(-350px)";
        setTimeout(function () {
            document.getElementById("black_screen_MSL").style.display = "none";
            document.getElementById("menu_sanduiche_left").style.display = "none";
        }, 400);

    }
}
/* Script para puxar o menu lateral */

/* Script para puxar o modal de exclusão */
EXCLUIR = "OFF";
function Exibir_Deletar() {

    if (EXCLUIR == "OFF") {

        EXCLUIR = "ON";
        document.getElementById("center_div_excluir").style.display = "flex";
        document.getElementById("black_screen_Excluir").style.display = "block";
        setTimeout(function () {
            document.getElementById("modalExcluirTicket").style.transform = "translateY(0px)";
            document.getElementById("black_screen_Excluir").style.opacity = "1";
        }, 100);
    } else if (EXCLUIR == "ON") {

        EXCLUIR = "OFF";
        document.getElementById("modalExcluirTicket").style.transform = "translateY(-500px)";
        document.getElementById("black_screen_Excluir").style.opacity = "0";
        setTimeout(function () {
            document.getElementById("center_div_excluir").style.display = "none";
            document.getElementById("black_screen_Excluir").style.display = "none";
        }, 400);

    }
}
/* Script para puxar o modal de exclusão */


/* Script para puxar o modal de novo ticket */
NEWTICKET = "OFF"
NOVOCLIENTE = "OFF"
function Exibir_Novo_Ticket(input) {

    if ((input == "") && (NEWTICKET == "OFF")) {
        location.href = "../../cadastro_ticket/index.php";
    }
}
/* Script para puxar o modal de novo ticket */


/* Script para puxar o modal de informação do ticket */
INFOTICKET = "OFF";
ITENSTICKET = "OFF"
function Exibir_Info_Ticket(input) {

    if ((input == "") && (INFOTICKET == "OFF")) {

        INFOTICKET = "ON";
        document.getElementById("center_div_infoTicket").style.display = "flex";
        document.getElementById("black_screen_infoTicket").style.display = "block";
        setTimeout(function () {
            document.getElementById("modalinfoTicket").style.transform = "translateY(0px)";
            document.getElementById("black_screen_infoTicket").style.opacity = "1";
        }, 100);
    } else if ((input == "") && (INFOTICKET == "ON")) {

        INFOTICKET = "OFF";
        document.getElementById("modalinfoTicket").style.transform = "translateY(-500px)";
        document.getElementById("black_screen_infoTicket").style.opacity = "0";
        document.getElementById("modalinfoTicket2").style.opacity = "0";
        setTimeout(function () {
            ITENSTICKET = "ON";
            Exibir_Info_Ticket('itensTicket');
            document.getElementById("center_div_infoTicket").style.display = "none";
            document.getElementById("black_screen_infoTicket").style.display = "none";
        }, 400);

    } else if (input == "itensTicket") {

        if (ITENSTICKET == "OFF") {
            ITENSTICKET = "ON";
            document.getElementById("modalinfoTicket2").style.display = "block";
            setTimeout(function () {
                document.getElementById("modalinfoTicket2").style.opacity = "1";
                document.getElementById("modalinfoTicket2").style.transform = "translateX(-420px)";
            }, 100);

        } else if (ITENSTICKET == "ON") {
            ITENSTICKET = "OFF";
            document.getElementById("modalinfoTicket2").style.opacity = "0";
            document.getElementById("modalinfoTicket2").style.transform = "translateX(0px)";
            setTimeout(function () {
                document.getElementById("modalinfoTicket2").style.display = "none";
            }, 400);
        }

    }
}
/* Script para puxar o modal de informação do ticket */


function testee() {
    alert("ta clicando sim");
}




/* 27/03 */

/* ========================== SCRIPTS HÍCARO =====================*/

function mask(o, f) {
    v_obj = o;
    v_fun = f;
    setTimeout("execmask()", 1)
}

function execmask() {
    v_obj.value = v_fun(v_obj.value);
}

function masktel(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
    v = v.replace(/(\d)(\d{4})$/, "$1-$2");
    return v;
}

function idcss(el) {
    return document.getElementById(el);
}

window.onload = function () {

    //TEL CELULAR
    idcss('telefone').setAttribute('maxlength', 15);
    idcss('telefone').onkeypress = function () {
        mask(this, masktel);
    }

    //TEL FIXO
    idcss('telefone_fixo').setAttribute('maxlength', 14);
    idcss('telefone_fixo').onkeypress = function () {
        mask(this, masktel);
    }

}

function atribuirCliente() {

    const selectElement2 = document.getElementById('clientes');
    const input2 = document.getElementById('clienteEscolhido');

    const valorSelecionado2 = selectElement2.value;
    input2.value = valorSelecionado2;
}

let num = 0;

function atribuirProduto() {

    const selectElement = document.getElementById('produtos');
    const input = document.getElementById('produtoEscolhido');

    const valorSelecionado = selectElement.selectedOptions[0].textContent;

    input.value = valorSelecionado.substring(0, valorSelecionado.indexOf(' '));


    const inputNomeProduto = document.getElementById('nome_item');
    inputNomeProduto.value = valorSelecionado;

}

function atribuirData() {

    const data1 = document.getElementById('data_entrega2');
    const data2 = document.getElementById('data_entrega3');

    const data = new Date(data1.value);
    const dataFormatada = data.toLocaleDateString('pt-BR', { year: 'numeric', month: '2-digit', day: '2-digit' });
    data2.value = dataFormatada.split('/').reverse().join('-');

}

function calcula_preco() {

    const selectElement = document.getElementById('produtos');
    const selectElement2 = document.getElementById('quantidade');

    const input = document.getElementById('preco');

    const valorSelecionado = selectElement.selectedOptions[0].textContent;
    const valorSelecionado2 = selectElement2.value;

    let ultimoEspaco = valorSelecionado.lastIndexOf(" ");
    let resultado = valorSelecionado.substr(ultimoEspaco + 1);

    let r = parseFloat(resultado) * parseFloat(valorSelecionado2);

    input.value = "R$ " + r.toFixed(2);

}