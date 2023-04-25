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

function mask(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmask()",1)
    }
    
    function execmask(){
    v_obj.value=v_fun(v_obj.value)
    }
    
    function masktel(v){
    v=v.replace(/\D/g,"");
    v=v.replace(/^(\d{2})(\d)/g,"($1) $2");
    v=v.replace(/(\d)(\d{4})$/,"$1-$2");
    return v;
    }
    
    function maskcpf(v){ 
    v=v.replace(/\D/g,"");
    v=v.replace(/(\d{3})(\d)/,"$1.$2");
    v=v.replace(/(\d{3})(\d)/,"$1.$2");
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
    return v;
    }

    function maskcep(v){
        v = v.replace(/\D/g,'')
        v = v.replace(/(\d{5})(\d)/,'$1-$2')
        return v;
    }
    
    function idcss( el ){
        return document.getElementById( el );
    }
    
    function mascara(){
    
        //CELULAR -------
        idcss('telefone').setAttribute('maxlength', 15);
        idcss('telefone').onkeypress = function(){
            mask( this, masktel );
        }
        //-------------
        
        
        //CPF ---------
        idcss('cpf').setAttribute('maxlength', 14);
        idcss('cpf').onkeypress = function(){
            mask( this, maskcpf );
        }
        //-------------
        
        idcss('cep').setAttribute('maxlength', 9);
        idcss('cep').onkeypress = function(){
            mask( this, maskcep );
        }
    }

    
function go_to_page(input){

    if(input == "GestaoFuncionarios"){
        location.href = "../gestao_funcionarios_adm/"
    }
    
    if(input == "Logo"){
        location.href = "../login"
    }

}


    

    