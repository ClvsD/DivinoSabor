function cadCliente() {

    if (document.getElementById("artCadCliente").style.display == "flex") {
        document.getElementById("artCadCliente").style.display = "none"
        document.getElementById("artEndereco").style.display = "flex"
    } else {
        document.getElementById("artCadCliente").style.display = "flex"
        document.getElementById("artEndereco").style.display = "none"
    }

}

function mask(o, f) {
    v_obj = o
    v_fun = f
    setTimeout("execmask()", 1)
}

function execmask() {
    v_obj.value = v_fun(v_obj.value)
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

    //TEL FIXO -------
    idcss('telefone_fixo').setAttribute('maxlength', 14);
    idcss('telefone_fixo').onkeypress = function () {
        mask(this, masktel);
    }
    //-------------

    //CELULAR -------
    idcss('telefone').setAttribute('maxlength', 15);
    idcss('telefone').onkeypress = function () {
        mask(this, masktel);
    }
    //-------------
}

click = "";

function atribuir() {
    var click = document.getElementById('clientes');
    var input = document.getElementById('id_cliente');
    input.value = click.value;
}

function atribuirData() {
    var click = document.getElementById('data');
    var input = document.getElementById('data_entrega');
    input.value = click.value;
}

function atribuirPacote1() {
    var click = document.getElementById('selecionarNome1');
    var input = document.getElementById('itemSelecionado2');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    input.innerHTML = click.textContent;

    var click2 = document.getElementById('selecionarPreco1');
    var input2 = document.getElementById('valor');
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg1');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;


    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;

}

function atribuirPacote2() {
    var click = document.getElementById('selecionarNome2');
    var click2 = document.getElementById('selecionarPreco2');

    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;

    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg2');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;
    
    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;

}

function atribuirPacote3() {
    var click = document.getElementById('selecionarNome3');
    var click2 = document.getElementById('selecionarPreco3');

    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg3');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;

    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;
    

}

function atribuirPacote4() {
    var click = document.getElementById('selecionarNome4');
    var click2 = document.getElementById('selecionarPreco4');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');

    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg4');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;

    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;
    

}

function atribuirPacote5() {
    var click = document.getElementById('selecionarNome5');
    var click2 = document.getElementById('selecionarPreco5');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');

    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg5');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;

    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;
    

}

function atribuirPacote6() {
    var click = document.getElementById('selecionarNome6');
    var click2 = document.getElementById('selecionarPreco6');

    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg6');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;
    
    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;

}

function atribuirPacote7() {
    var click = document.getElementById('selecionarNome7');
    var click2 = document.getElementById('selecionarPreco7');

    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg7');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;

    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;
    

}

function atribuirPacote8() {
    var click = document.getElementById('selecionarNome8');
    var click2 = document.getElementById('selecionarPreco8');

    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg8');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;

    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;
    

}

function atribuirPacote9() {
    var click = document.getElementById('selecionarNome9');
    var click2 = document.getElementById('selecionarPreco9');

    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg9');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;

    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;
    

}

function atribuirPacote10() {
    var click = document.getElementById('selecionarNome10');
    var click2 = document.getElementById('selecionarPreco10');

    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg10');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;

    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;
    

}

function atribuirPacote11() {
    var click = document.getElementById('selecionarNome11');
    var click2 = document.getElementById('selecionarPreco11');

    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg11');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;

    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;
    

}

function atribuirPacote12() {
    var click = document.getElementById('selecionarNome12');
    var click2 = document.getElementById('selecionarPreco12');

    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg12');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;

    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;
    

}

function atribuirPacote13() {
    var click = document.getElementById('selecionarNome13');
    var click2 = document.getElementById('selecionarPreco13');

    var input = document.getElementById('itemSelecionado2');
    var input2 = document.getElementById('valor');
    var input4 = document.getElementById('nomePacoteValor');
    input4.value = click.textContent;
    input.innerHTML = click.textContent;
    input2.innerHTML = 'R$ ' + click2.textContent;

    var input3 = document.getElementById('valor2');
    input3.innerHTML = 'R$ ' + click2.textContent;

    var click3 = document.getElementById('secImg13');
    const backgroundImage = window.getComputedStyle(click3).getPropertyValue('background-image');
    var input3 = document.getElementById('secImg');
    input3.style.backgroundImage = backgroundImage;

    var click4 = document.getElementById('inputTotal');
    var valorDinheiro = input2.textContent;
    let ultimoEspaco = valorDinheiro.lastIndexOf(" ");
    let resultado = valorDinheiro.substr(ultimoEspaco + 1);
    const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
    click4.value = valorNumerico;
    

}

function calcula_valor(){
    if(!document.getElementById('inpuDesconto').value == 0){
        const desconto = document.getElementById('inpuDesconto').value;
        var input2 = document.getElementById('valor').textContent;
    
        let ultimoEspaco = input2.lastIndexOf(" ");
        let resultado = input2.substr(ultimoEspaco + 1);
    
        const valorNumerico = parseFloat(resultado.replace('.', '').replace(',', '.'));
        const valorDesconto = parseInt(desconto);
    
        var input3 = document.getElementById('valor2');
        var input4 = document.getElementById('valorDesconto');
    
        var calculo = valorNumerico - (valorNumerico * (valorDesconto/100));
        var calculo2 = valorNumerico * (valorDesconto/100);
    
        input3.innerHTML = calculo.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});;
        input4.innerHTML = '- ' + calculo2.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'});
    
        var input5 = document.getElementById('inputTotal');
        input5.value = calculo.toFixed(2);
    }
}

function atribuirEndereco(){
    const in1 = document.getElementById('endereco')
    const in2 = document.getElementById('cidade')
    const in3 = document.getElementById('bairro')
    const in4 = document.getElementById('numero_casa')
   
    const out1 = document.getElementById('enderecoValor')
    const out2 = document.getElementById('cidadeValor')
    const out3 = document.getElementById('bairroValor')
    const out4 = document.getElementById('numero_casaValor')

    out1.value = in1.value;
    out2.value = in2.value;
    out3.value = in3.value;
    out4.value = in4.value;

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


function VerifyEmpty(){
    pass = 0;

    

    TestarRua = document.getElementById("endereco").value;
    TestarNumero = document.getElementById("numero_casa").value;
    TestarBairro = document.getElementById("bairro").value;
    TestarCidade = document.getElementById("cidade").value;
    TestarComplemento = document.getElementById("complemento").value;
    TestarData = document.getElementById("data").value;
    TestarSelect = document.getElementById("clientes").value;
    TestarProduto = document.getElementById("itemSelecionado2").textContent;

    
    if(TestarSelect == ""){
        document.getElementById("artSelect").style.border = "1px solid red";
        document.getElementById("artSelect").style.transition = "0.5s";

        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        Command: toastr["error"]("Motivo: Cliente não selecionado", "Selecione um cliente")

        
        $("#carouselExampleDark").carousel(0);

        return false;


    } else {
        document.getElementById("artSelect").style.border = "0px solid #c8c8c8";
        pass ++;
    }

    if(TestarRua == ""){
        document.getElementById("endereco").style.border = "1px solid red";
        document.getElementById("endereco").style.transition = "0.5s";

        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        Command: toastr["error"]("Motivo: Rua não informada", "Erro de digitação!")

        $("#carouselExampleDark").carousel(0);

        return false;

    } else {
        document.getElementById("endereco").style.border = "2px solid #c8c8c8";
        pass ++;
        
    }

    if(TestarNumero == ""){
        document.getElementById("numero_casa").style.border = "1px solid red";
        document.getElementById("numero_casa").style.transition = "0.5s";

        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        Command: toastr["error"]("Motivo: Numero não informado", "Erro de digitação!")

        $("#carouselExampleDark").carousel(0);
        
        return false;

    } else {
        document.getElementById("numero_casa").style.border = "2px solid #c8c8c8";
        pass ++;
        
    }

    if(TestarBairro == ""){
        document.getElementById("bairro").style.border = "1px solid red";
        document.getElementById("bairro").style.transition = "0.5s";

        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        Command: toastr["error"]("Motivo: Bairro não informado", "Erro de digitação!")

        $("#carouselExampleDark").carousel(0);

        return false;

    } else {
        document.getElementById("bairro").style.border = "2px solid #c8c8c8";
        pass ++;
        
    }

    if(TestarCidade == ""){
        document.getElementById("cidade").style.border = "1px solid red";
        document.getElementById("cidade").style.transition = "0.5s";

        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        Command: toastr["error"]("Motivo: Cidade não informada", "Erro de digitação!")

        $("#carouselExampleDark").carousel(0);

        return false;


    } else {
        document.getElementById("cidade").style.border = "2px solid #c8c8c8";
        pass ++;
        
    }

    if(TestarComplemento == ""){
        document.getElementById("complemento").style.border = "2px solid red";
        document.getElementById("complemento").style.transition = "0.5s";

        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        Command: toastr["error"]("Motivo: Complemento não informado", "Erro de digitação!")

        $("#carouselExampleDark").carousel(0);

        return false;


    } else {
        document.getElementById("complemento").style.border = "2px solid #c8c8c8";
        pass ++;
        
    }

    if(TestarData == ""){
        document.getElementById("data").style.border = "1px solid red";
        document.getElementById("data").style.transition = "0.5s";

        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        Command: toastr["error"]("Motivo: Data para entrega não informada", "Erro de digitação!")

        $("#carouselExampleDark").carousel(0);

        return false;


    } else {
        document.getElementById("data").style.border = "2px solid #c8c8c8";
        pass++
        
    }
    
    
        if((TestarProduto == "Selecione um produto na página anterior") && (pass == 7)){

            toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
            Command: toastr["info"]("Por favor, selecione um produto antes de prosseguir", "Falta pouco!")

            $("#carouselExampleDark").carousel(1);

        return false;

        }

        if((TestarProduto != "Selecione um produto na página anterior") && (pass == 7)){
            $("#carouselExampleDark").carousel("next");
        }

        if(pass < 7 ){
            $("#carouselExampleDark").carousel(0);
        }

  
}

function ReturnCarousel(){

    if((TestarProduto != "Selecione um produto na página anterior") && (pass == 7)){
        $("#carouselExampleDark").carousel("prev");
    } else if((TestarProduto == "Selecione um produto na página anterior") && (pass == 7)){
        $("#carouselExampleDark").carousel(0);
    } else if(pass < 7 ){

    }   
    
}

new Cleave('#inpuDesconto', {
    blocks: [2],
    numericOnly: true
});

new Cleave('#numero_casa', {
    blocks: [4],
    numericOnly: true
});


function go_to_page(input){

    if(input == "GestaoTickets"){
        location.href = "../login"
    }

    if(input == "Logo"){
        location.href = "../login"
    }
}