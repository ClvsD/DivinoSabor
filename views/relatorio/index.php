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
  <link rel="stylesheet" href="Relatorio.css">
  <script src="Relatorio.js"></script>
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
  <script src="jquery-3.6.3.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!--Esses três links são responsáveis por fazer a caixa de pesquisa pesquisável-->

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body onload="TaxadeVendas(), MaisPedidos(), ReceberData()">


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
                <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-bookmark icon_size_02"></i> </div>
                <div class="text_space_01" onclick="go_to_page('GestaoTickets')"> <label class="cursor_pointer font_backup_02"> Tickets </label> </div>
            </div>

            <div class="container_MSL cursor_pointer">
                <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-id-badge icon_size_02"></i> </div>
                <div class="text_space_01" onclick="go_to_page('GestaoFuncionarios')"> <label class="cursor_pointer font_backup_02"> Gestão de Funcionários </label> </div>
            </div>

            <div class="container_MSL cursor_pointer">
                <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-user icon_size_02"></i> </div>
                <div class="text_space_01" onclick="go_to_page('GestaoClientes')"> <label class="cursor_pointer font_backup_02" > Gestão de clientes </label> </div>
            </div>

            <div class="container_MSL cursor_pointer">
                <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-chart-bar icon_size_02"></i> </div>
                <div class="text_space_01" onclick="go_to_page('Relatorios')"> <label class="cursor_pointer font_backup_02" style="color: green"> Relatórios </label> </div>
            </div>

            <a href="../../controller/FuncionarioController.php?logout=true" style="text-decoration: none; color: inherit;">
                <div class="container_MSL cursor_pointer">
                    <div class="icon_space_02"> <i class="cursor_pointer fa-solid fa-arrow-right-from-bracket  icon_size_02"></i> </div>
                    <div class="text_space_01" onclick="logoff()"> <label class="cursor_pointer font_backup_02"> Deslogar </label> </div>
                </div>
            </a>
            
        </aside>
        <!-- Menu sanduiche lateral -->


  <article id="art">
    <section id="secTitle">
      <h2 data-aos="fade-right" data-aos-duration="1500"> Relatório <i class="fa-solid fa-chart-simple fa-bounce" style="color: #45ba5c;"></i> </h2>
      <p data-aos="fade-right" data-aos-duration="2000"> A aba de gráficos financeiros da sua empresa ;) </p>
    </section>
  </article>

  <!-- Mini Container: margem de custos -->
  <article id="mini_dashboards_space">
    <section class="container_MD">
      <div class="main_info">
        <label data-aos="zoom-out" data-aos-duration="1000"> Margem de custos <i class="fa-solid fa-dollar-sign fa-fade" style="color: #ff7575;"></i> </label>
      </div>
      <div class="change_info_div">
        <button data-aos="zoom-out" data-aos-duration="1000" onclick="recebendoAno()"> <i class="fa-solid fa-repeat fa-spin" style="color: #9da3af;"></i> Mensal </button>
      </div>

      <div class="container_valor">
        <label data-aos="zoom-in" data-aos-duration="1000" class="value_text"><?php echo 'R$ ' . number_format($funcionariodao->calculaSalarioTotal(), 2, ',', '.'); ?></label>
      </div>

      <div class="container_porcentagem">
        <label data-aos="zoom-out" data-aos-duration="1000" class="bottom_text"> <i class="fa-solid fa-arrow-trend-up fa-shake" style="color: #36ce70;"></i> <label style="color: #50cf80"> -0,0% </label> <label style="color: #9da3af;"> em comparação com o </label> <label style="color: #ffa813"> mês </label> <label style="color: #9da3af;"> anterior </label> </label>
      </div>

    </section>
    <!-- Mini Container: margem de custos -->


    <!-- Mini Container: Funcionário do mês -->
    <section class="container_MD">
      <div class="main_info" id="trocar_exibicao">
        <label data-aos="zoom-out" data-aos-duration="1000" for="campo_data_funcionario"> Funcionário do mês  </label><i class="fa-solid fa-user fa-beat" style="color: #ffbc47;"></i>
      </div>
      <div class="change_info_div">
      <i class="fa-solid fa-repeat fa-spin" style="color: #9da3af;"></i><button data-aos="zoom-out" data-aos-duration="1000" id="campo_data_funcionario" onclick="trocarTextoFuncionario()">  Mensal </button>
      </div>
      
      <?php foreach ($funcionariodao->funcionarioDoMes() as $funcionario) : ?>
        <div id="doMes">
        <div class="container_valor" >
          <label data-aos="zoom-in" data-aos-duration="1000" class="value_text" style="color: rgb(255, 174, 0);"> <?= $funcionario->getNumero_Vendas() ?> <label style="color: rgb(0, 0, 0);"> Vendas </label> <i class="fa-solid fa-crown" style="color: #ffc547;"></i> </label>
        </div>

        <div class="container_porcentagem">
          <label data-aos="zoom-out" data-aos-duration="1000" class="bottom_text"> <?= $funcionario->getNome() ?> </label>
        </div>
        </div>
      <?php endforeach ?>
      
      <?php foreach ($funcionariodao->funcionarioDoAno() as $funcionario) : ?>
        <div id="doAno">
        <div class="container_valor" >
          <label data-aos="zoom-in" data-aos-duration="1000" class="value_text" style="color: rgb(255, 174, 0);"> <?= $funcionario->getNumero_Vendas() ?> <label style="color: rgb(0, 0, 0);"> Vendas </label> <i class="fa-solid fa-crown" style="color: #ffc547;"></i> </label>
        </div>

        <div class="container_porcentagem">
          <label data-aos="zoom-out" data-aos-duration="1000" class="bottom_text"> <?= $funcionario->getNome() ?> </label>
        </div>
        </div>
      <?php endforeach ?>
      

    </section>
    <!-- Mini Container: Funcionário do mês -->

    <!-- Mini Container: margem de lucros -->
    <section class="container_MD">
      <div class="main_info">
        <label data-aos="zoom-out" data-aos-duration="1000" for="campo_data_faturamento"> Margem de Faturamento <i class="fa-solid fa-dollar-sign fa-bounce" style="color: #487d47;"></i> </label>
      </div>
      <div class="change_info_div">
      <i class="fa-solid fa-repeat fa-spin" style="color: #9da3af;"></i><button data-aos="zoom-out" data-aos-duration="1000" id="campo_data_faturamento" onclick="trocarTextoFaturamento()">  Mensal </button>
      </div>

      <div id="fatMes">
      <div class="container_valor" >
        <label data-aos="zoom-in" data-aos-duration="1000" class="value_text"><?php echo 'R$ ' . number_format($ticketdao->calculaValorFinal(), 2, ',', '.'); ?></label>
      </div>

      <div class="container_porcentagem">
        <label data-aos="zoom-out" data-aos-duration="1000" class="bottom_text" style="color: #50cf80"> <i class="fa-solid fa-arrow-trend-up fa-shake" style="color: #50cf80;"></i> <?php echo (($ticketdao->calculaValorFinal() - $ticketdao->calculaValorFinalPassado()) / 100) * 100 ?>% <label style="color: #9da3af;"> em comparação com o </label> <label style="color: #ffa813" id="idm"> mês </label> <label style="color: #9da3af;"> anterior </label> </label>
      </div>
      </div>

      <div id="fatAno">
      <div class="container_valor" >
        <label data-aos="zoom-in" data-aos-duration="1000" class="value_text"><?php echo 'R$ ' . number_format($ticketdao->calculaValorFinalAno(), 2, ',', '.'); ?></label>
      </div>

      <div class="container_porcentagem">
        <label data-aos="zoom-out" data-aos-duration="1000" class="bottom_text" style="color: #50cf80"> <i class="fa-solid fa-arrow-trend-up fa-shake" style="color: #50cf80;"></i> <?php echo (($ticketdao->calculaValorFinalAno() - $ticketdao->calculaValorFinalPassadoAno()) / 100) * 100 ?>% <label style="color: #9da3af;"> em comparação com o </label> <label style="color: #ffa813" id="ida"> mês </label> <label style="color: #9da3af;"> anterior </label> </label>
      </div>
      </div>
    </section>
    <!-- Mini Container: margem de lucros -->


  </article>

  <article id="grafico_01">
    <section class="titulo_container">
      <label class="Title_01"> Taxa de Lucro </label>
      <button type="button" class="btn btn-outline-warning" onclick="window.print()"> Baixar em PDF </button>
    </section>

    <div class="container_grafico_01">

      <div id="TaxadeVendas">
        <div id="timeline-chart"></div>
      </div>

    </div>
  </article>

  <article id="grafico_02">
    <section class="titulo_container">
      <label class="Title_02 "> Planos mais pedidos </label>
    </section>

    <div class="container_grafico_02">
      <div id="maispedidos"></div>
    </div>
  </article>

  <article id="grafico_03">

    <label class="Title_02 "> Vendas dos funcionários </label>

    <section id="container_funcionarios">
      <ul>
        <?php foreach($funcionariodao->listaVendaFuncionarios() as $funcionario): ?>
        <li title="<?= $funcionario->getNumero_Vendas() . ' Venda(s)' ?> - <?= $funcionario->getNome(); ?>" class="listagem_funcionario"> <label style="color: #e78e00;"> <?= $funcionario->getNumero_Vendas() . ' Venda(s)' ?> </label>  <?= " - " . $funcionario->getNome(); ?> </li>
        <?php endforeach ?>
      </ul>
    </section>
    
  </article>

          

</body>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
  AOS.init();
</script>

<script>
  /* Script pra saber o mês atual */
  function ReceberMesAtual() {

    const month = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
    const d = new Date();
    let mes = month[d.getMonth()];

    return mes;

  }
  /* Script pra saber o mês atual */

  function TaxadeVendas() {

    var options = {
      series: [{
        name: "Total de vendas do mês R$ ",
        data: [ /* Insira neste vetor os valores referentes a cada mês */
        <?php echo $ticketdao->calculaValorFinalMes(1) - $funcionariodao->calculaSalarioTotal(); ?>, /* Janeiro */
        <?php echo $ticketdao->calculaValorFinalMes(2) - $funcionariodao->calculaSalarioTotal(); ;?> , /* Fevereiro */
        <?php echo $ticketdao->calculaValorFinalMes(3) - $funcionariodao->calculaSalarioTotal(); ;?> , /* Março */
        <?php echo $ticketdao->calculaValorFinalMes(4) - $funcionariodao->calculaSalarioTotal(); ;?> , /* Abril */
        <?php echo $ticketdao->calculaValorFinalMes(5) - $funcionariodao->calculaSalarioTotal(); ;?> , /* Maio */
        <?php echo $ticketdao->calculaValorFinalMes(6) - $funcionariodao->calculaSalarioTotal(); ;?> , /* Julho */
        <?php echo $ticketdao->calculaValorFinalMes(7) - $funcionariodao->calculaSalarioTotal(); ;?> , /* Junho */
        <?php echo $ticketdao->calculaValorFinalMes(8) - $funcionariodao->calculaSalarioTotal(); ;?> , /* Agosto */
        <?php echo $ticketdao->calculaValorFinalMes(9) - $funcionariodao->calculaSalarioTotal(); ;?> , /* Setembro */
        <?php echo $ticketdao->calculaValorFinalMes(10) - $funcionariodao->calculaSalarioTotal(); ;?> , /* Outubro */
        <?php echo $ticketdao->calculaValorFinalMes(11) - $funcionariodao->calculaSalarioTotal(); ;?> , /* Novembro */
        <?php echo $ticketdao->calculaValorFinalMes(12) - $funcionariodao->calculaSalarioTotal(); ;?> /* Dezembro */
        ] 
      }],
      chart: {
        height: 350,
        type: 'line',
        zoom: {
          enabled: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        colors: ['#e78e00']
      },
      title: {
        text: 'Sobreponha com o mouse para saber quanto vendeu nos ultimos meses',
        align: 'left'
      },
      grid: {
        row: {
          colors: ['#f1f1f1', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },
      },
      xaxis: {
        categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      },
      annotations: {
        xaxis: [{
          x: ReceberMesAtual(),
          borderColor: '#9da3af',
          label: {
            style: {
              color: '#e78e00',
            },
            text: 'Você esta aqui'
          }
        }]
      }


    };



    var chart = new ApexCharts(document.querySelector("#TaxadeVendas"), options);
    chart.render();





  }


  function MaisPedidos() {

    var options = {

      chart: {
        width: 375,
        type: "pie"
      },
      fill: {
        colors: ['#FC5404', '#fb680b', '#fb7a17', '#fa8923', '#f99831', '#f9a63f', '#f8b24f', '#f8bf5f', '#f8cb70', '#f9d682', '#fae194', '#fceca7', '#fff6ba'],
      },
      dataLabels: {
        enabled: false
      },
      series: [<?php echo $ticketdao->contaPacote('Casamento Tradicional'); ?>, <?php echo $ticketdao->contaPacote('Casamento Intermediário'); ?>, <?php echo $ticketdao->contaPacote('Casamento Premium'); ?>, <?php echo $ticketdao->contaPacote('Aniversário Clássico'); ?>, <?php echo $ticketdao->contaPacote('Festa de Debutante'); ?>, <?php echo $ticketdao->contaPacote('Formandos Tradicional'); ?>, <?php echo $ticketdao->contaPacote('Formandos Premium'); ?>, <?php echo $ticketdao->contaPacote('Coffe Break Classic'); ?>, <?php echo $ticketdao->contaPacote('Coffe Break Prime'); ?>, <?php echo $ticketdao->contaPacote('Coffe Break Premium'); ?>, <?php echo $ticketdao->contaPacote('Reveillon Tradicional'); ?>, <?php echo $ticketdao->contaPacote('Reveillon Prime'); ?>, <?php echo $ticketdao->contaPacote('Reveillon Premium'); ?>],
      labels: ['Casamento Tradicional', 'Casamento Intermediário', 'Casamento Premium', 'Aniversário Clássico', 'Festa de Debutante', 'Formandos Tradicional', 'Formandos Premium', 'Coffe Break Classic', 'Coffe Break Prime', 'Coffe Break Premium', 'Reveillon Tradicional', 'Reveillon Prime', 'Reveillon Premium']


    };

    var chart = new ApexCharts(document.querySelector("#maispedidos"), options);

    chart.render();
    }

    function trocarTextoFuncionario() {
        const textoAntigo = document.getElementById("campo_data_funcionario");
        const funcionarioDo = document.querySelector('label[for="campo_data_funcionario"]');
        const funcDoMes = document.getElementById("doMes");
        const funcDoAno = document.getElementById("doAno");

        if (textoAntigo.textContent === "Mensal") {
          textoAntigo.textContent = "Anual";
          funcionarioDo.innerText= "Funcionário do Ano ";
          funcDoAno.style.display = 'block';
          funcDoMes.style.display = 'none';
        } else {
          textoAntigo.textContent = "Mensal";
          funcionarioDo.innerText = "Funcionário do Mês ";
          funcDoAno.style.display = 'none';
          funcDoMes.style.display = 'block';
        }
      }

      function trocarTextoFaturamento() {
        const textoAntigo = document.getElementById("campo_data_faturamento");
        const faturamentoDoMes = document.querySelector('#idm');
        const faturamentoDoAno = document.querySelector('#ida');
        const fatDoMes = document.getElementById("fatMes");
        const fatDoAno = document.getElementById("fatAno");

        if (textoAntigo.textContent === "Mensal") {

          textoAntigo.textContent = "Anual";
          faturamentoDoAno.innerText = "ano";
          fatDoAno.style.display = 'block';
          fatDoMes.style.display = 'none';

        } else {

          textoAntigo.textContent = "Mensal";
          faturamentoDoMes.innerText = "mês";
          fatDoAno.style.display = 'none';
          fatDoMes.style.display = 'block';

        }
      }

</script>

</html>