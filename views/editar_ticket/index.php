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
    <link rel="stylesheet" href="editar_ticket.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6ad8afcd8c.js" crossorigin="anonymous"></script>
    <title>DS - Editar Ticket</title>
</head>

<body>

  
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
            <div class="text_space_01" onclick="go_to_page('GestaoTickets')"> <label class="cursor_pointer font_backup_02" style="color:green"> Tickets </label> </div>
        </div>

        <a href="../../../controller/FuncionarioController.php?logout=true" style="text-decoration: none; color: inherit;">
            <div class="container_MSL cursor_pointer">
                <div class="icon_space_02"> <i class="cursor_pointer fa-solid fa-arrow-right-from-bracket  icon_size_02"></i> </div>
                <div class="text_space_01" onclick="logoff()"> <label class="cursor_pointer font_backup_02"> Deslogar </label> </div>
            </div>
        </a>
    </aside> 
    <!-- Menu sanduiche lateral -->

    <main id="main">
        <article id="artStatus">
            <h6>Editando Ticket</h6>
            <h6>|</h6>
            <p>#004</p>
        </article>

        <div id="carouselExampleDark" class="carousel carousel-dark slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>

            <!-- Parte 1. Cliente -->
            <!-- **************** -->

            <?php foreach ($ticketdao->editar() as $ticket) : ?>
                <form action="../../controller/TicketController.php" method="post">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">

                       
                        <article id="linha"></article>

                        <article id="artEndereco">
                            <section class="secInput">
                                <input type="text" style="display: none;" name="id_ticket" value="<?= $ticket->getID() ?>" />
                                <p>Nome do cliente<i class="asterisk">*</i></p>
                                <input type="text" value="<?= $ticket->getNome_Cliente() ?>" disabled>
                            </section>
                            <section class="secInput">
                                <p>Rua <i class="asterisk">*</i></p>
                                <input type="text" value="<?= $ticket->getEndereco() ?>" name="endereco" id="" required>
                            </section>
                            <section class="secInput">
                                <p>Número <i class="asterisk">*</i></p>
                                <input type="text" value="<?= $ticket->getNumero_Casa() ?>" name="numero_casa" id="" required>
                            </section>
                            <section class="secInput">
                                <p>Bairro <i class="asterisk">*</i></p>
                                <input type="text" value="<?= $ticket->getBairro() ?>" name="bairro" id="" required>
                            </section>
                            <section class="secInput">
                                <p>Cidade <i class="asterisk">*</i></p>
                                <input type="text" value="<?= $ticket->getCidade() ?>" name="cidade" id="" required>
                            </section>
                            <section class="secInput">
                                <p>Complemento </p>
                                <input type="text" name="" id="">
                            </section>
                            <section class="secInput">
                                <p>Data da entrega <i class="asterisk">*</i></p>
                                <input type="date" value="<?= $ticket->getDataEntrega() ?>" min=<?php echo date('Y-m-d');?> name="data_entrega" id="" required>
                                <button id="btnCheck" data-bs-target="#carouselExampleDark" data-bs-slide="next"><i class="fa-solid fa-arrow-right fa-lg"></i></button>
                            </section>
                        </article>
                        
                    </div>
                

                <!-- Parte 3. Valor -->
                <!-- ************** -->
                <div class="carousel-item" data-bs-interval="2000">

                    <article id="linha"></article>

                    <article id="artProduto2">

                        <section class="secCard2">
                            <section class="secNome">
                                <section class="secImg"></section>
                                <section>
                                    <h6>Pacote:</h6>
                                    <p><?php echo $ticket->getNome_Pacote(); ?></p>
                                    <section>
                                        <p class="itemSelecionado"> Item selecionado</p></button>
                                    </section>
                                </section>
                            </section>
                        </section>
                        <section>
                            <section class="secVal" style="border-bottom: none; color: orange;">
                                <p>VALOR </p>
                                <h6> <s> R$ 00,00</s></h6>
                            </section>
                            <section class="secVal" style="border-bottom: none;">
                                <p>DESCONTO </p>
                                <h6 style="color: red;"><s>- R$ 00,00</s></h6>
                            </section>
                            <section class="secVal" style="margin-bottom: 20px; color: #5eaac0;">
                                <p>TOTAL A PAGAR </p>
                                <h6><?php echo 'R$ ' . $ticket->getValor_Final(); ?></h6>
                            </section>
                            <section>
                                <p>Observação</p>
                                <textarea name="observacao" id=""><?php echo $ticket->getObservacao();?></textarea>
                            </section>
                            <section><button class="btnAbrir" type="submit" name="alterar"> Editar</button></section>
                        </section>
                        </form>
                    </article>
                </div>
                </div>
                <?php endforeach ?>

                <!-- botões carousel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
        </div>
    </main>

    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>

</html>