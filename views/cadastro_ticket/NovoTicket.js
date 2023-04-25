form_cliente_state = "OFF";
function cadastrar_cliente(){

    if(form_cliente_state == "OFF"){
        form_cliente_state = "ON";
        document.getElementById("forms_cliente").style.visibility = "visible";
        document.getElementById("forms_cliente").style.opacity = "1";
        document.getElementById("button_novoCliente").classList.remove('btn-outline-dark');
        document.getElementById("button_novoCliente").classList.add('btn-dark');
    }else if(form_cliente_state == "ON"){
        document.getElementById("forms_cliente").style.opacity = "0";
        document.getElementById("forms_cliente").style.visibility = "hidden";
        document.getElementById("button_novoCliente").classList.remove('btn-dark');
        document.getElementById("button_novoCliente").classList.add('btn-outline-dark');
        form_cliente_state = "OFF";


    }

    
}

page = 0;
function next_page(){

    if(page == "0"){
        document.getElementById("article_main").style.opacity = "0";
        document.getElementById("article_main").style.visibility = "hidden";
        document.getElementById("article_main").style.display = "none";

        document.getElementById("article_second").style.display = "block";
        
        page = 1;
    } else if (page == "1"){
        document.getElementById("article_main").style.opacity = "1";
        document.getElementById("article_main").style.visibility = "visible";
        document.getElementById("article_main").style.display = "block";

        document.getElementById("article_second").style.display = "none";
        
        page = 0;
    }   

}



function return_tickets(){

            location.href="../../index.php";
}