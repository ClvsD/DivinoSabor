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


function go_to_page(page) {

    if (page == "GestaoProdutos") {
        location.href = "../../views/gestao_produtos_adm/";

    } else if (page == "GestaoClientes") {
        location.href = "../../views/gestao_clientes_adm/";

    } else if (page == "GestaoTickets") {
        location.href = "../login";

    } else if (page == "GestaoFuncionarios") {
        location.href = "../../views/gestao_funcionarios_adm/";

    } else if (page == "Relatorios") {
        location.href = "../../views/relatorio/";

    } else if (page == "NovoTicket") {
        location.href = "../../views/cadastro_ticket/";

    } else if(input == "Logo"){
        location.href = "../../views/login"
        
    } else {
        alert("Pagina nao encontrada, tente novamente");
    }

}
