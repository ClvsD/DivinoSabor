function go_to_page(page) {

    if (page == "GestaoProdutos") {
        location.href = "../../../views/gestao_produto_adm/index.php";

    } else if (page == "GestaoClientes") {
        location.href = "../../../views/gestao_clientes_adm/index.php";

    } else if (page == "GestaoTickets") {
        location.href = "../../../views/users/admin/index.php";

    } else if (page == "GestaoFuncionarios") {
        location.href = "../../../views/gestao_funcionarios_adm/index.php";

    } else if (page == "Relatorios") {
        location.href = "../../../views/relatorio/";

    } else if (page == "NovoTicket") {
        location.href = "../../../views/cadastro_ticket/index.php";

    } else if(input == "Logo"){
        location.href = "../../../views/login"
        
    } else {
        alert("Pagina nao encontrada, tente novamente");
    }

}

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

