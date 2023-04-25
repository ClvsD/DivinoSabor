<?php

session_start();

require_once('../../config/Conexao.php');
require_once('../../model/Funcionario.php');
require_once('../../dao/FuncionarioDao.php');
require_once('../../model/Cliente.php');
require_once('../../dao/ClienteDao.php');
require_once('../../model/Ticket.php');
require_once('../../dao/TicketDao.php');

$funcionario = new Funcionario();
$funcionariodao = new FuncionarioDao();
$cliente = new Cliente();
$clientedao = new ClienteDao();
$ticket = new Ticket();
$ticketdao = new TicketDao();

$login = new FuncionarioDao();

if(!$login->checkLogin() || $login->checkAdmin() != "Gerente") {
  header("Location: ../../../");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script><!-- Bootstrap -->

  <!-- Script e CSS da página-->
  <link rel="stylesheet" href="cadastro_funcionario.css">
  <script src="cadastro_funcionario.js"></script>
  <!-- Script e CSS da página-->

  <title> Janelas Modal </title>

  <!-- FONT AWESOME -->
  <script src="https://kit.fontawesome.com/2db99d343f.js" crossorigin="anonymous"></script>
  <!-- FONT AWESOME -->

  <!-- AOS ANIMATE -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- AOS ANIMATE -->

  <!--Esses três links são responsáveis por fazer a caixa de pesquisa pesquisável-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!--Esses três links são responsáveis por fazer a caixa de pesquisa pesquisável-->

  
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  
</head>

<body onload="mascara()">
  
<header>
        <!-- Ativação do Menu Sanduiche -->
        <section id="menu-sanduiche" onclick="Exibir_MSL()">
            <i class="fa-solid fa-bars"></i>
        </section>
        <!-- Ativação do Menu Sanduiche -->

        <section id="logo" onclick="go_to_page('Logo')">
            <h3>Divino <img src="img/LOGO.PNG" alt=""> Sabor</h3>
        </section>

        <section>
            <label class="name_logado"> <?php echo $funcionariodao->retornaNome(); ?> </label>
        </section>
        
        <section id="user_logo">
        </section>
    </header>

    <style>
        #user_logo {
            background-image: url("../../img/<?php echo $funcionariodao->retornaImagem(); ?>");
        }
    </style>


  <section id="black_screen_MSL" onclick="Exibir_MSL()"></section>

  <!-- Menu sanduiche lateral -->
  <aside id="menu_sanduiche_left">

    <div class="container_MSL cursor_pointer">
      <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-id-badge icon_size_02"></i> </div>
      <div class="text_space_01" onclick="go_to_page('GestaoFuncionarios')"> <label class="cursor_pointer font_backup_02"> Gestão de Funcionários </label> </div>
    </div>

    <a href="../../../controller/FuncionarioController.php?logout=true" style="text-decoration: none; color: inherit;">
      <div class="container_MSL cursor_pointer">
        <div class="icon_space_02"> <i class="cursor_pointer fa-solid fa-arrow-right-from-bracket  icon_size_02"></i> </div>
        <div class="text_space_01" onclick="logoff()"> <label class="cursor_pointer font_backup_02"> Deslogar </label> </div>
      </div>
    </a>

  </aside>
  <!-- Menu sanduiche lateral -->


  <section class="header">
    <button type="button" onclick="go_to_page('GestaoFuncionarios')" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </section>

  <form action="../../controller/FuncionarioController.php" onsubmit="return VerifyEmpty()" method="post" enctype="multipart/form-data">
    <article id="article_left">

      <div class="container-fluid div_form">
        <label class="title_form_default"> Nome do funcionário </label>
        <input type="text" class="input_text_default" id="nome" name="nome" placeholder="Insira o nome do funcionário" >
      </div>


      <div class="container-fluid div_form">
        <label class="title_form_default"> Turno </label>
        <Div class="select2_fix">
          <select class="input_text_default " id="turno" name="turno" style="width: 100%" >
            <option></option> <!-- Deixe em branco pro placeholder funcionar -->
            <option value="Integral">Integral </option>
            <option value="Matutino">Matutino</option>
            <option value="Vespertino">Vespertino </option>
            <option value="Noturno">Noturno </option>
          </select>
        </Div>
      </div>


      <div class="container-fluid div_form">
        <label class="title_form_default"> Salário </label>
        <input type="text" class="input_text_default" id="salario" name="salario" onchange="validaSalario()" placeholder="Digite o salário do funcionário" >
      </div>


      <div class="container-fluid div_form">
        <label class="title_form_default"> Função do Funcionário </label>
        <Div class="select2_fix">
          <select class="input_text_default" id="tipoContrato" name="tipo" style="width: 100%" >
            <option></option> <!-- Deixe em branco pro placeholder funcionar -->
            <option value="Gerente"> Gerente </option>
            <option value="Cozinheiro"> Cozinheiro (a) </option>
            <option value="Garçom"> Garçom </option>
            <option value="Limpeza"> Limpeza </option>
            <option value="Contabilidade"> Contabilidade </option>
            <option value="Administrador"> Administrador (a) </option>
            <option value="Logística"> Logística </option>
            <option value="Marketing"> Marketing </option>
          </select>
        </Div>
      </div>

      <div class="container-fluid div_form">
        <label class="title_form_default"> Email </label>
        <input type="email" class="input_text_default" id="email"name="mail" placeholder="Insira o email do funcionário" >
      </div>


      <div class="container-fluid div_form">
        <label class="title_form_default"> Telefone </label>
        <input type="tel" class="input_text_default" id="telefone" name="telefone" placeholder="Insira o telefone do funcionário" >
      </div>


      <div class="container-fluid div_form">
        <label class="title_form_default"> CEP </label>
        <input type="text" class="input_text_default" id="cep" name="cep" onchange="apiCep()" placeholder="Insira o CEP do funcionário" >
      </div>

      <div class="container-fluid div_form">
        <label class="title_form_default"> Endereço </label>
        <input type="text" class="input_text_default" id="endereco" name="endereco" placeholder="Insira a rodovia, rua ou avenida" >
      </div>

      <div class="container-fluid div_form">
        <label class="title_form_default"> Numero </label>
        <input type="text" class="input_text_default" id="numero_casa" name="numero_casa" placeholder="Insira o numero da residência do funcionário" >
      </div>

      <div class="container-fluid div_form">
        <label class="title_form_default"> Bairro </label>
        <input type="text" class="input_text_default" id="bairro" name="bairro" placeholder="Insira o bairro do funcionário" >
      </div>

      <div class="container-fluid div_form">
        <label class="title_form_default"> Cidade </label>
        <input type="text" class="input_text_default" id="cidade" name="cidade" placeholder="Insira a cidade do funcionário" >
      </div>

      <div class="container-fluid div_form">
        <label class="title_form_default"> CPF </label>
        <input type="text" class="input_text_default" id="cpf" name="cpf" onchange="TestaCPF()" placeholder="Insira o CPF do funcionário" >
      </div>

      <div class="container-fluid div_form">
        <label class="title_form_default"> Senha </label>
        <input type="password" class="input_text_default" id="senha" name="senha" placeholder="Insira a senha do funcionário" >
      </div>

      <input type="hidden" name="data_contratacao" value="<?php echo date('Y-m-d') ?>" />


    </article>


    <article id="article_right">

      <div class="container-fluid text-center">
        <label class="title_funcionario"> FOTO DO FUNCIONÁRIO </label>
      </div>

      <section class="image_space container-fluid d-flex justify-content-center">
        <input type="file" class="upload_btn" name="foto" onchange="mostrarImg(event)" required />
        <div id="overlay-layer1"> <i class="fa-regular fa-image"></i> </div>
        <div id="overlay-layer2"> Selecione e arraste <br> ou CLIQUE para buscar </div>
        <img id="overlay-layer3" style="border:none;"></img>
        <div id="overlay-layer4"> <label> Envie somente .PNG / .JPG / JPEG / GIF </label></div>
      </section>

      <section class="button_space">
        <button type="submit" name="cadastrar" class="btn btn-outline-warning"> Cadastrar funcionário </button>
      </section>
    </article>
  </form>
</body>

<script type="text/javascript">
  var mostrarImg = function(event) {

    document.getElementById("overlay-layer1").style.opacity = "0";
    document.getElementById("overlay-layer2").style.width = "20%";
    document.getElementById("overlay-layer2").style.height = "40%";
    document.getElementById("overlay-layer3").style.width = "20%";
    document.getElementById("overlay-layer2").style.color = "rgba(0, 0, 0, 0)";
    document.getElementById("overlay-layer4").style.opacity = "0";



    var ler = new FileReader();
    ler.onload = function() {
      var mostrar = document.getElementById("overlay-layer3");
      mostrar.src = ler.result;
    }
    ler.readAsDataURL(event.target.files[0]);


  }
</script>

<script>
  $(document).ready(function() {
    $('#turno').select2({
      placeholder: "Selecione um turno",
      allowClear: true
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#tipoContrato').select2({
      placeholder: "Selecione o tipo de contrato",
      allowClear: true
    });
  });
</script>

<script>
  function apiCep() {
    let cep = document.querySelector('#cep').value;

    let url = `https://viacep.com.br/ws/${cep}/json/`;

    fetch(url).then(function(response) {
      response.json().then(mostrarEndereco);
    });
  }

  function mostrarEndereco(dados){
    let cidade = document.querySelector('#cidade');
    let bairro = document.querySelector('#bairro');
    let endereco = document.querySelector('#endereco');
  
    if(dados.erro){
      
    }
    else{
      cidade.value = `${dados.localidade}`
      bairro.value = `${dados.bairro}`
      endereco.value = `${dados.logradouro}`
    }
  }

</script>

  <!-- JS TOAST-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- CSS TOAST -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</html>