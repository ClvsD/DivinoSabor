<?php

session_start();

include '../../config/Conexao.php';
include '../../dao/ClienteDao.php';
include '../../model/Cliente.php';
include '../../dao/FuncionarioDao.php';
include '../../model/Funcionario.php';

$clientedao = new ClienteDao();
$cliente = new Cliente();
$funcionariodao = new FuncionarioDao();

$login = new FuncionarioDao();

if(!$login->checkLogin()) {
    header("Location: ../../");
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Cadastro_ticket.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/6ad8afcd8c.js" crossorigin="anonymous"></script>
  <title>DS - Cadastrar Ticket</title>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <!-- JQUERY TOAST-->
  <script src="jquery-3.6.3.min.js"></script>
  <!-- JS TOAST-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- CSS TOAST -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        
  
</head>

<body >

    
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
      <div class="text_space_01" onclick="go_to_page('GestaoTickets')"> <label class="cursor_pointer font_backup_02" style="color:red"> Tickets </label> </div>
    </div>

    <a href="../../controller/FuncionarioController.php?logout=true" style="text-decoration: none; color: inherit;">
      <div class="container_MSL cursor_pointer">
        <div class="icon_space_02"> <i class="cursor_pointer fa-solid fa-arrow-right-from-bracket  icon_size_02"></i> </div>
        <div class="text_space_01" onclick="logoff()"> <label class="cursor_pointer font_backup_02"> Deslogar </label> </div>
      </div>
    </a>

  </aside>
  <!-- Menu sanduiche lateral -->


  <main id="main">
    <article id="artStatus">

      <h6>Criando Ticket</h6>
      <h6>|</h6>
      <p>#004</p>

      <button type="button" onclick="go_to_page('GestaoTickets')" class="btn-close ml-auto p-2" data-bs-dismiss="modal" aria-label="Close"></button>

    </article>


    <div id="carouselExampleDark" class="carousel carousel-dark slide">
      <!-- <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" ></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div> -->

      <!-- Parte 1. Cliente -->
      <!-- **************** -->
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
          <article id="artSelect">
            <div class="btn-group" id="dropdown-filter">
              <select id="clientes" onchange="atribuir()">
                <option value="" selected="selected">Selecione um Cliente</option>
                <?php foreach ($clientedao->listAllNames() as $cliente) : ?>
                  <option value=<?= $cliente->getID(); ?>><?= $cliente->getNome() . ' - ' . $cliente->getTelefone() ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <p>Ou então</p> <button id="btnCadastrar" onclick="cadCliente()"> Cadastre um cliente </button>
          </article>

          <form action="../../controller/ClienteController.php" method="post">
            <article id="artCadCliente">
              <section class="secInput">
                <p>Nome do cliente <i class="asterisk">*</i></p>
                <input type="text" name="nome" id="nome" required>
              </section>
              <section class="secInput">
                <p>Celular <i class="asterisk">*</i></p>
                <input type="text" name="telefone" id="telefone" required>
              </section>
              <section class="secInput secInputTel">
                <p>Telefone fixo</p>
                <input type="text" name="telefone_fixo" id="telefone_fixo" required>
                <button id="btnCheck" type="submit" name="create"><i class="fa-solid fa-check"></i></button>
              </section>
            </article>
          </form>

          <article id="linha"></article>

          <article id="artEndereco">
            <section class="secInput">
              <p>Rua <i class="asterisk">*</i></p>
              <input type="text" id="endereco" required onchange="atribuirEndereco()" >
            </section>
            <section class="secInput">
              <p>Número <i class="asterisk">*</i></p>
              <input type="text" id="numero_casa" maxlength="5" required onchange="atribuirEndereco()">
            </section>
            <section class="secInput">
              <p>Bairro <i class="asterisk">*</i></p>
              <input type="text" id="bairro" required onchange="atribuirEndereco()">
            </section>
            <section class="secInput">
              <p>Cidade <i class="asterisk">*</i></p>
              <input type="text" id="cidade" required onchange="atribuirEndereco()">
            </section>
            <section class="secInput">
              <p>Complemento </p>
              <input type="text" id="complemento" name="">
            </section>
            <section class="secInput">
              <p>Data da entrega <i class="asterisk">*</i></p>
              <input type="date" name="data" id="data" min=<?php echo date('Y-m-d');?> required onchange="atribuirData()">
              <button onclick="VerifyEmpty()" id="btnCheck" ><i class="fa-solid fa-check"></i></button>
            </section>

           
          </article>

        </div>

        <!-- Parte 2. Pacotes venda -->
        <!-- ********************** -->
        <div class="carousel-item" data-bs-interval="2000">
          <article id="artProduto">
          
            <article id="artScroll">
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg1"></section>
                  <section class="secPacote">
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome1">Casamento Tradicional</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco1">2.990,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteCasamentoTradicional"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote1()" data-bs-target="#carouselExampleDark" data-bs-slide="next"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg2"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome2">Casamento Intermediário</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco2">3.990,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteCasamentoIntermediario"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote2()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg3"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome3">Casamento Premium</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco3">5.990,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteCasamentoPremium"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote3()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg4"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome4">Aniversário Clássico</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco4">1.990,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteAniversarioClassico"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote4()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg5"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome5">Festa de Debutante</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco5">5.790,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteFestadeDebutante"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote5()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg6"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome6">Formandos Tradicional</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco6">1.990,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteFormandosTradicional"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote6()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg7"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome7">Formandos Premium</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco7">2.990,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteFormandosPremium"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote7()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg8"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome8">Coffe Break Classic</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco8">990,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteCoffeBreakClassic"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote8()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg9"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome9">Coffe Break Prime</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco9">1.290,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteCoffeBreakPrime"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote9()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg10"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome10">Coffe Break Premium</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco10">1.590,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteCoffeBreakPremium"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote10()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg11"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome11">Reveillon Tradicional</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco11">3.290,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteReveillonTradicional"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote11()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg12"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome12">Reveillon Prime</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco12">4.690,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteReveillonPrime"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote12()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
              <section class="secCard">
                <section class="secNome">
                  <section id="secImg13"></section>
                  <section>
                    <h6>Pacote:</h6>
                    <p class="nomePacote" id="selecionarNome13">Reveillon Premium</p>
                  </section>
                </section>
                <section class="secValor">
                  <h6>R$</h6>
                  <p id="selecionarPreco13">5.990,90</p>
                </section>
                <button class="secInfo" data-bs-toggle="modal" data-bs-target="#ItensPacoteReveillonPremium"><i class="fa-solid fa-circle-info fa-lg colorIcon"></i></button>
                <section><button class="btnSelecionar" class="carousel-control-next" type="button" onclick="atribuirPacote13()" data-bs-target="#carouselExampleDark" data-bs-slide="next" onclick="atribuirPacote()"> Selecionar</button></section>
              </section>
            </article>
          </article>
        </div>

        <!-- Parte 3. Valor -->
        <!-- ************** -->
        <div class="carousel-item" data-bs-interval="2000">
          <article id="artProduto2">

            <section class="secCard2">
              <section class="secNome">
                <section class="secImg" id="secImg"></section>
                <section>
                  <h6>Pacote:</h6>
                  <p id="itemSelecionado2">Selecione um produto na página anterior</p>
                  <section>
                    <p class="itemSelecionado"> Item Selecionado</p></button>
                  </section>
                </section>
              </section>
            </section>

            <section id="secInputDesconto">
              <section style="margin-top: 27px;">
                <p>Aplicar desconto</p>
                <input type="text" name="" id="inpuDesconto" placeholder="%">
              </section>
              <section><button class="btnSelecionar" style="margin-top: 50px;" onclick="calcula_valor()"> Aplicar</button></section>
            </section>
          </article>
          <article id="artValor">
            <form action="../../controller/TicketController.php" method="post" onsubmit="return VerifyEmpty()" >

              <input type="hidden" id="id_cliente" name="id_cliente" />
              <input type="hidden" value="<?php echo $_SESSION['user_session'] ?>" name="id_funcionario" />
              <input type="hidden" id="data_entrega" name="data_entrega" />
              <input type="hidden" name="data_criacao" value=<?php echo date('Y-m-d') ?> />
              <input type="hidden" name="status" value="Em andamento" />
              <input type="hidden" id="nomePacoteValor" name="nome_pacote" />
              <input type="hidden" id="enderecoValor" name="endereco" />
              <input type="hidden" id="cidadeValor" name="cidade" />
              <input type="hidden" id="bairroValor" name="bairro" />
              <input type="hidden" id="numero_casaValor" name="numero_casa" />

              <section class="">
                <section class="secVal" style="border-bottom: none; color: orange;">
                  <p>VALOR </p>
                  <h6 id="valor"></h6>
                </section>
                <section class="secVal" style="border-bottom: none;">
                  <p>DESCONTO </p>
                  <h6 style="color: red;" id="valorDesconto"></h6>
                </section>
                <section class="secVal" style="margin-bottom: 20px; color: #5eaac0;">
                  <p>TOTAL A PAGAR </p>
                  <h6 id="valor2"></h6>
                </section>
                <section>
                  <p>Observações</p>
                  <textarea name="observacao"></textarea>
                </section>

                <input type="hidden" name="valor_final" id="inputTotal" />
                <section><button  class="btnAbrir" type="submit" name="create"> Abrir Ticket</button></section>
              </section>

            </form>
          </article>
        </div>

      </div>

      <!-- botões carousel -->
      <button class="carousel-control-prev" type="button" onclick="ReturnCarousel()" >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" onclick="VerifyEmpty()">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </main>

  <!-- Modal Itens do pack Casamento Tradicional -->
  <div class="modal fade" id="ItensPacoteCasamentoTradicional" aria-hidden="true" aria-labelledby="ItensPacoteCasamentoTradicional" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Casamento Tradicional </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Obs: Serve até 50 pessoas</p>
          <p>• 5x garçons </p>
          <p>• 2x cozinheiros </p>
          <p>• Refeições Personalizadas (Tropeiro, Feijoada, entre outros.) </p>
          <p>• 200x talheres</p>
          <p>• 1x bolo de casamento - 4 andares</p>
          <p>• 550x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
          <p>• 400x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
          <p>• Decoração completa</p>
          <p>• Organização e Limpeza do Local</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Casamento Tradicional -->

  <!-- Modal Itens do pack Casamento Intermediário -->
  <div class="modal fade" id="ItensPacoteCasamentoIntermediario" aria-hidden="true" aria-labelledby="ItensPacoteCasamentoIntermediario" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Casamento Intermediário </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Obs: Serve até 80 pessoas </p>
          <p>• 7x garçons </p>
          <p>• 3x cozinheiros </p>
          <p>• Refeições Personalizadas (Tropeiro, Feijoada, entre outros.) </p>
          <p>• 250x talheres</p>
          <p>• 1x bolo de casamento - 5 andares</p>
          <p>• 650x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
          <p>• 500x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
          <p>• Decoração completa</p>
          <p>• Organização e Limpeza do Local</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Casamento Intermediário -->

  <!-- Modal Itens do pack Casamento Premium -->
  <div class="modal fade" id="ItensPacoteCasamentoPremium" aria-hidden="true" aria-labelledby="ItensPacoteCasamentoPremium" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Casamento Premium </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Obs: Serve até 120 pessoas </p>
          <p>• 10x garçons </p>
          <p>• 2x cozinheiros </p>
          <p>• Refeições Personalizadas (Tropeiro, Feijoada, entre outros.) </p>
          <p>• 350x talheres</p>
          <p>• 1x bolo de casamento – 6 andares</p>
          <p>• 900x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
          <p>• 650x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
          <p>• Decoração completa</p>
          <p>• Organização e Limpeza do Local</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Casamento Premium -->

  <!-- Modal Itens do pack Aniversário Clássico -->
  <div class="modal fade" id="ItensPacoteAniversarioClassico" aria-hidden="true" aria-labelledby="ItensPacoteAniversarioClassico" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Aniversário Clássico </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>OBS: Serve até 30 pessoas</p>
        <p>•5x garçons</p>
        <p>•150x talheres</p>
        <p>•1x bolo personalizado - 4,5 a 4,8 KG</p>
        <p>•350x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
        <p>• 450x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
        <p>•Decoração completa</p>
        <p>•Organização e limpeza do local</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Aniversário Clássico -->

  <!-- Modal Itens do pack Festa de Debutante -->
  <div class="modal fade" id="ItensPacoteFestadeDebutante" aria-hidden="true" aria-labelledby="ItensPacoteItensPacoteFestadeDebutante" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Festa de Debutante </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>OBS: Serve até 130 pessoas</p>
        <p>•10x garçons </p>
        <p>•370x talheres</p>
        <p>•2x bolo personalizado - 4,5 a 4,8 KG </p>
        <p>•950x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
        <p>•600x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
        <p>•Decoração completa</p>
        <p>•Organização e limpeza do local</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Festa de Debutante -->

  <!-- Modal Itens do pack Formandos Tradicional -->
  <div class="modal fade" id="ItensPacoteFormandosTradicional" aria-hidden="true" aria-labelledby="ItensPacoteFormandosTradicional" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Formandos Tradicional </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>OBS: Serve até 35 pessoas</p>
        <p>•5x garçons </p>
        <p>•250x talheres</p>
        <p>•1x bolo personalizado - de 6 andares </p>
        <p>•350x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
        <p>•350x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
        <p>•Decoração completa</p>
        <p>•Organização e limpeza do local</p>

        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Formandos Tradicional -->

  <!-- Modal Itens do pack Formandos Premium -->
  <div class="modal fade" id="ItensPacoteFormandosPremium" aria-hidden="true" aria-labelledby="ItensPacoteFormandosPremium" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Formandos Premium </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p> OBS: Serve até 75 pessoas</p>
        <p>•7x garçons </p>
        <p>•350x talheres</p>
        <p>•1x bolo personalizado - de 6 andares </p>
        <p>•650x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
        <p>•650x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
        <p>•Decoração completa</p>
        <p>•Organização e limpeza do local</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Formandos Premium -->

  <!-- Modal Itens do pack Coffe Break Classic -->
  <div class="modal fade" id="ItensPacoteCoffeBreakClassic" aria-hidden="true" aria-labelledby="ItensPacoteCoffeBreakClassic" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Coffe Break Classic </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>OBS: Serve até 10 pessoas</p>
        <p>•2x garçons </p>
        <p>•50x talheres</p>
        <p>•1x bolo personalizado - 2,5 a 2,8 KG </p>
        <p>•5L de café ou chá a escolha</p>
        <p>•100x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
        <p>•150x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
        <p>•Decoração completa</p>
        <p>•Organização e limpeza do local</p>

        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Coffe Break Classic -->

  <!-- Modal Itens do pack Coffe Break Prime -->
  <div class="modal fade" id="ItensPacoteCoffeBreakPrime" aria-hidden="true" aria-labelledby="ItensPacoteCoffeBreakPrime" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Coffe Break Prime </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>OBS: Serve até 20 pessoas</p>
        <p>•3x garçons </p>
        <p>•100x talheres</p>
        <p>•1x bolo personalizado - 4,5 a 4,8 KG</p>
        <p>•8L de cafe ou chá a escolha </p>
        <p>•150x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
        <p>•150x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
        <p>•Decoração completa</p>
        <p>•Organização e limpeza do local</p>

        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Coffe Break Prime -->

  <!-- Modal Itens do pack Coffe Break Premium -->
  <div class="modal fade" id="ItensPacoteCoffeBreakPremium" aria-hidden="true" aria-labelledby="ItensPacoteCoffeBreakPremium" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Coffe Break Premium </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>OBS: Serve até 30 pessoas</p>
        <p>•4x garçons </p>
        <p>•150x talheres</p>
        <p>•1x bolo personalizado - 4,5 a 4,8 KG</p>
        <p>•12 L de cafe ou chá a escolha </p>
        <p>•170x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
        <p>•200x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
        <p>•Decoração completa</p>
        <p>•Organização e limpeza do local</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Coffe Break Premium -->

  <!-- Modal Itens do pack Reveillon Tradicional -->
  <div class="modal fade" id="ItensPacoteReveillonTradicional" aria-hidden="true" aria-labelledby="ItensPacoteReveillonTradicional" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Reveillon Tradicional </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>OBS: Serve até 20 pessoas</p>
        <p>•3x garçons </p>
        <p>•100x talheres</p>
        <p>•1x bolo personalizado - 4,5 a 4,8 KG</p>
        <p>•200x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
        <p>•200x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
        <p>•Decoração completa</p>
        <p>•Organização e limpeza do local</p>

        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Reveillon Tradicional -->

  <!-- Modal Itens do pack Reveillon Prime -->
  <div class="modal fade" id="ItensPacoteReveillonPrime" aria-hidden="true" aria-labelledby="ItensPacoteReveillonPrime" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Reveillon Prime </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>OBS: Serve até 50 pessoas</p>
        <p>•5x garçons </p>
        <p>•200x talheres</p>
        <p>•1x bolo personalizado - 4,5 a 4,8 KG</p>
        <p>•350x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
        <p>•300x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
        <p>•Decoração completa</p>
        <p>•Organização e limpeza do local</p>

        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Reveillon Prime -->

  <!-- Modal Itens do pack Reveillon Premium -->
  <div class="modal fade" id="ItensPacoteReveillonPremium" aria-hidden="true" aria-labelledby="ItensPacoteReveillonPremium" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem no pacote Reveillon Premium </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <p>OBS: Serve até 100 pessoas</p>
        <p>•10x garçons </p>
        <p>•300x talheres</p>
        <p>•2x bolo personalizado - 4,5 a 4,8 KG</p>
        <p>•600x salgados (Coxinhas, Empadas, Quibes, Enroladinhos de Presunto e Muçarela, Pastéis Assados, Bodas, Catavento, Croissant, Delícia de Tomate Seco, Florzinha de Frango, Quiches, Rolovã, Bombons Crocantes, Medalhões, Tortulete, Barquetes, Trouxinhas, Canapés, Bolinho de Bacalhau, Camarão Chinês, Damasco Coroado, Encanto de Siri e outros)</p>
        <p>•650x doces (Brigadeiro, Beijinho, Dois Amores, Chapéu de Napoleão, Moranguinho, Ouriço, Cambalhota, Torrinha, Uvita, Coloridinho, Prestigio, Bombons, Musses, Trufas e outras delícias.)</p>
        <p>•Decoração completa</p>
        <p>•Organização e limpeza do local</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Itens do pack Reveillon Premium -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js" integrity="sha512-KaIyHb30iXTXfGyI9cyKFUIRSSuekJt6/vqXtyQKhQP6ozZEGY8nOtRS6fExqE4+RbYHus2yGyYg1BrqxzV6YA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="index.js" async></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  
  <script>
    $(document).ready(function() {
      $('#clientes').select2();
    });
  </script>

</body>

</html>