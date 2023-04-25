function cadCliente(){

    if(document.getElementById("artCadCliente").style.display == "flex"){
        document.getElementById("artCadCliente").style.display = "none"
        document.getElementById("artEndereco").style.display = "flex"
    }else{
        document.getElementById("artCadCliente").style.display = "flex"
        document.getElementById("artEndereco").style.display = "none"
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

function go_to_page(input){

    if(input == "GestaoTickets"){
        location.href = "../login"
    }

    if(input == "Logo"){
        location.href = "../login"
    }

}