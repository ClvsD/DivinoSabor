

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

function maskcpf(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d)/, "$1.$2");
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    return v;
}

function maskcep(v) {
    v = v.replace(/\D/g, '')
    v = v.replace(/(\d{5})(\d)/, '$1-$2')
    return v;
}

function idcss(el) {
    return document.getElementById(el);
}

function mascara() {

    //CELULAR -------
    idcss('telefone').setAttribute('maxlength', 15);
    idcss('telefone').onkeypress = function () {
        mask(this, masktel);
    }
    //-------------


    //CPF ---------
    idcss('cpf').setAttribute('maxlength', 14);
    idcss('cpf').onkeypress = function () {
        mask(this, maskcpf);
    }
    //-------------

    idcss('cep').setAttribute('maxlength', 9);
    idcss('cep').onkeypress = function () {
        mask(this, maskcep);
    }
}

function VerifyEmpty() {

    TesteNomeFuncionario = $("input[name=nome]").val();
    TesteTurno = $("input[name=turno]").val();
    TesteSalario = $("input[name=salario]").val();
    TesteContrato = $("input[name=tipo]").val();
    TesteEmail = $("input[name=mail]").val();
    TesteTelefone = $("input[name=telefone]").val();
    TesteCEP = $("input[name=cep]").val();
    TesteRua = $("input[name=endereco]").val();
    TesteNumero = $("input[name=numero_casa]").val();
    TesteBairro = $("input[name=bairro]").val();
    TesteCidade = $("input[name=cidade]").val();
    TesteCPF = $("input[name=cpf]").val();
    TesteSenha = $("input[name=senha]").val();

    if (TesteNomeFuncionario == "") {
        document.getElementById("nome").style.border = "2px solid red";
        document.getElementById("nome").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Nome do funcionário não encontrado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;

    } else {
        document.getElementById("nome").style.border = "2px solid green";
    }

    if (TesteTurno == "") {
        document.getElementById("turno").style.border = "2px solid red";
        document.getElementById("turno").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Turno do funcionário não informado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;

    } else {
        document.getElementById("turno").style.border = "2px solid green";
    }

    if (TesteSalario == "") {
        document.getElementById("salario").style.border = "2px solid red";
        document.getElementById("salario").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Salário do funcionário não informado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;
    } else {
        document.getElementById("salario").style.border = "2px solid green";
    }

    if (TesteContrato == "") {
        document.getElementById("tipoContrato").style.border = "2px solid red";
        document.getElementById("tipoContrato").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Tipo do contrato não citado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;
    } else {
        document.getElementById("tipoContrato").style.border = "2px solid green";
    }

    if (TesteEmail == "") {
        document.getElementById("email").style.border = "2px solid red";
        document.getElementById("email").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Email do funcionário não citado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;

    } else {
        document.getElementById("email").style.border = "2px solid green";
    }

    if (TesteTelefone == "") {
        document.getElementById("telefone").style.border = "2px solid red";
        document.getElementById("telefone").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Telefone do funcionário não informado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;

    } else {
        document.getElementById("telefone").style.border = "2px solid green";
    }

    if (TesteCEP == "") {
        document.getElementById("cep").style.border = "2px solid red";
        document.getElementById("cep").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: CEP do funcionário não encontrado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;
    } else {
        document.getElementById("cep").style.border = "2px solid green";
    }

    if (TesteRua == "") {
        document.getElementById("endereco").style.border = "2px solid red";
        document.getElementById("endereco").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Endereço do funcionário não encontrado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;

    } else {
        document.getElementById("endereco").style.border = "2px solid green";
    }

    if (TesteNumero == "") {
        document.getElementById("numero_casa").style.border = "2px solid red";
        document.getElementById("numero_casa").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Número do funcionário não informado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;

    } else {
        document.getElementById("numero_casa").style.border = "2px solid green";
    }

    if (TesteBairro == "") {
        document.getElementById("bairro").style.border = "2px solid red";
        document.getElementById("bairro").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Bairro do funcionário não informado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;


    } else {
        document.getElementById("bairro").style.border = "2px solid green";
    }

    if (TesteCidade == "") {
        document.getElementById("cidade").style.border = "2px solid red";
        document.getElementById("cidade").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Cidade do funcionário não informado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;


    } else {
        document.getElementById("cidade").style.border = "2px solid green";
    }

    if (TesteCPF == "") {
        document.getElementById("cpf").style.border = "2px solid red";
        document.getElementById("cpf").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: CPF do funcionário não informado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        return false;


    } else {
        document.getElementById("cpf").style.border = "2px solid green";
    }

    if (TesteSenha == "") {
        document.getElementById("senha").style.border = "2px solid red";
        document.getElementById("senha").style.transition = "0.5s";

        Command: toastr["warning"]("Motivo: Senha do funcionário não informado", "Erro ao cadastrar funcionário")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-left",
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

        return false;

    } else {
        document.getElementById("senha").style.border = "2px solid green";
    }


}

Command: toastr["info"]("Aqui você precisa preencher todos os campos do formulário para poder prosseguir.", "Seja bem-vindo ao cadastro de funcionário")

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
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



function go_to_page(input) {

    if (input == "GestaoFuncionarios") {
        location.href = "../gestao_funcionarios_adm/index.php"
    }

    if (input == "Logo") {
        location.href = "../login"
    }
}

function TestaCPF() {

    cpf = document.getElementById('cpf').value;

    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf == '') return false;
    // Elimina CPFs invalidos conhecidos	
    if (cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999")
        return false;
    // Valida 1o digito	
    add = 0;
    for (i = 0; i < 9; i++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9)))
        return document.getElementById('cpf').value=""; //Quando o cpf tá errado ele tá só apagando o campo
    // Valida 2o digito	
    add = 0;
    for (i = 0; i < 10; i++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10)))
        return document.getElementById('cpf').value=""; //Quando o cpf tá errado ele tá só apagando o campo
        // return true; Quando o cpf tá certo
}

function validaSalario(){

    input = document.getElementById('salario').value;
    let num = parseFloat(input);

    if (isNaN(num)) {
    document.getElementById('salario').value="";
    } else {
    console.log("O valor inserido é um número decimal válido: " + num);
    }
}