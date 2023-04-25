<?php

error_reporting(0);

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


$id_funcionario = $_SESSION['user_session'];


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
    <link rel="stylesheet" href="modal.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/b9abc5f66a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <title>ADM - Clientes</title>
    <script src="modal.js"></script>
  
    <!-- JQUERY TOAST-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- JS TOAST-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- CSS TOAST -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
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


    <div>
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
                <div class="text_space_01" onclick="go_to_page('GestaoClientes')"> <label class="cursor_pointer font_backup_02" style="color:#F9A410"> Gestão de clientes </label> </div>
            </div>

            <div class="container_MSL cursor_pointer">
                <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-chart-bar icon_size_02"></i> </div>
                <div class="text_space_01" onclick="go_to_page('Relatorios')"> <label class="cursor_pointer font_backup_02"> Relatórios </label> </div>
            </div>

            <a href="../../controller/FuncionarioController.php?logout=true" style="text-decoration: none; color: inherit;">
                <div class="container_MSL cursor_pointer">
                    <div class="icon_space_02"> <i class="cursor_pointer fa-solid fa-arrow-right-from-bracket  icon_size_02"></i> </div>
                    <div class="text_space_01" onclick="logoff()"> <label class="cursor_pointer font_backup_02"> Deslogar </label> </div>
                </div>
            </a>
            
        </aside>
        <!-- Menu sanduiche lateral -->



        <!-- Modal Excluir -->
        <form action="../../controller/ClienteController.php" method="post">
        <div class="modal fade" id="ExcluirModal" tabindex="-1" aria-labelledby="ExcluirModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja Excluir esse cliente?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="container-fluid"> <input name="id_cliente" class="idClienteExcluir" id="idClienteInfo" type="text"> </div>
                            <br />
                            <div class="container-fluid"> <input name="nome" class="nomeClienteExcluir" id="ExcluirNomeCliente" disabled type="text" placeholder="Nome completo do cliente "> </div>
                            <div class="container-fluid"> <input name="telefone_fixo" class="telefoneClienteExcluir" disabled  id="ExcluirTelefoneCliente"  type="text" placeholder="Telefone"> </div>
                            <div class="container-fluid"> <input name="telefone" class="celularClienteExcluir" disabled  id="ExcluirCelularCliente" type="text" placeholder="Celular"> </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancelar <i class="fa-solid fa-ban"></i></button>
                        <button type="submit" name="excluir" class="btn btn-danger"> Excluir <i class="fa-solid fa-trash"></i> </button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- Modal Excluir -->

        <!-- Modal Criar Cliente -->
        <div class="modal fade" id="CriarCliente" tabindex="-1" aria-labelledby="CriarCliente" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> Digite os dados do novo cliente </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="../../controller/ClienteController.php" method="post">

                            <div class="container-fluid"> <input id="NomeCliente" type="text" name="nome" placeholder="Nome completo do cliente " required> </div>
                            <div class="container-fluid"> <input id="TelefoneCliente" type="text" name="telefone" placeholder="Telefone"> </div>
                            <div class="container-fluid"> <input id="CelularCliente" type="text" name="telefone_fixo" placeholder="Celular" required> </div>

                    </div>
                    <div class="modal-footer me-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancelar <i class="fa-solid fa-ban"></i> </button>
                        <button class="btn btn-warning" type="submit" name="create2"> Cadastrar Cliente <i class="fa-solid fa-plus"></i> </button>
                    </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- Modal Editar Cliente -->
        <form action="../../controller/ClienteController.php" method="post" name="edit">
        <div class="modal fade" id="EditarCliente" tabindex="-1" aria-labelledby="EditarCliente" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 ms-3" id="exampleModalLabel">Deseja Editar este cliente?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                            <div class="container-fluid"> <input name="id_cliente" class="idClienteInfo" id="idClienteInfo" type="text"> </div>
                            <br />
                            <div class="container-fluid"> <input name="nome" class="nomeClienteInfo" id="EditNomeCliente" type="text" placeholder="Nome completo do cliente " required> </div>
                            <div class="container-fluid"> <input name="telefone_fixo" class="telefoneClienteInfo"  id="EditTelefoneCliente"  type="text" placeholder="Telefone"> </div>
                            <div class="container-fluid"> <input name="telefone" class="celularClienteInfo"  id="EditCelularCliente" type="text" placeholder="Celular" required> </div>
                    </div>
                    <div class="modal-footer me-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancelar <i class="fa-solid fa-ban"></i> </button>
                        <button type="submit" name="alterar" class="btn btn-warning"> Editar <i class="fa-solid fa-pen"></i> </button>
                        
                    </div>
                </div>
            </div>
        </div>
        </form>
        <main id="main">

            <article id="art">
                <section id="secTitle">
                    <h2>Gestão de Clientes <i class="fa-solid fa-users-gear fa-bounce" style="color: #e49504;"></i> </h2>
                    <p> Aba para gerenciar seus clientes já cadastrados</p>
                </section>
                <button id="btn" data-bs-toggle="modal" data-bs-target="#CriarCliente">+ Novo Cliente</button>
            </article>

            <hr>

            <article id="art2">
                <section>
                    <h2>Filtros</h2>
                    <div class="btn-group" id="dropdown-filter">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categoria
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="filtrar" method="post">
                                <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_pedidos" value="1" onclick="acionarFiltros()" for="Nome" /> Nome <i class="fa-solid fa-arrow-down-z-a"> </i> </label> </li>
                                <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_pedidos" value="2" onclick="acionarFiltros()" for="Nome" /> Nome <i class="fa-solid fa-arrow-down-a-z"> </i> </label> </li>
                                <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_pedidos" value="3" onclick="acionarFiltros()" for="Total pedidos" /> Total pedidos <i class="fa-solid fa-arrow-down-1-9"></i> </label> </li>
                                <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_pedidos" value="4" onclick="acionarFiltros()" for="Total pedidos" /> Total pedidos <i class="fa-solid fa-arrow-down-9-1"></i> </label> </li>
                            </form>
                        </ul>
                    </div>
                </section>
                <section id="secLimpar">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="filtrar" method="post">
                        <input type="number" value="5" name="filtragem_pedidos" hidden />
                        <button type="submit" id="btnLimpar">x Limpar Filtro</button>
                    </form>
                </section>

            </article>


            <article id="artTitles">
                <section class="secTable">
                    <p>Nome</p>
                </section>
                <section class="secTable">
                    <p>Celular</p>
                </section>
                <section class="secTable">
                    <p>Total de Pedidos</p>
                </section>
                <section class="secTable">
                    <p>Opções</p>
                </section>
            </article>

            
            <article id="artCards">
                <?php foreach ($clientedao->filtragem() as $cliente) : ?>
                    <section class="cards"> <!-- foreach aqui  -->
                        <section class="secTable" title="<?= $cliente->getNome() ?>">
                            <h5 style="color:#fff"><?= $cliente->getNome() ?></h5>
                        </section>
                        <section class="secTable" title="<?= $cliente->getTelefone() ?>">
                            <h5 style="color:#fff"><?= $cliente->getTelefone() ?></h5>
                        </section>
                        <section class="secTable" title="<?= $cliente->getTotal_Pedidos() ?>">
                            <h5 style="color:#fff"><?= $cliente->getTotal_Pedidos() ?></h5>
                        </section>
                        <section class="secTable dFlex">
                            <div class="btn-group dropup float-end mt-2 me-3 ">

                                <button class="elipsis-fix" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical fa-xl rotate cPointer colorIcon"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li> <a class="abrir_modal dropdown-item" data-bs-toggle="modal" data-bs-target="#EditarCliente" data-valor='<?php echo json_encode(array("idCliente" => $cliente->getID(), "nomeCliente" => $cliente->getNome(), "telefone" => $cliente->getTelefone_Fixo(), "celular" => $cliente->getTelefone())); ?>'> <i class="fa-solid fa-pen"></i> Editar dados do cliente </a></li>

                                    <li> <a class="abrir_modal2 dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ExcluirModal" data-valor='<?php echo json_encode(array("idCliente" => $cliente->getID(), "nomeCliente" => $cliente->getNome(), "telefone" => $cliente->getTelefone_Fixo(), "celular" => $cliente->getTelefone())); ?>'> <i class="fa-solid fa-trash"></i> Excluir dados do cliente </a></li>
                                </ul>

                            </div>

                        </section>
                    </section>
                <?php endforeach ?>
            </article>


        </main>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

        <script>
            function acionarFiltros() {
                if (document.querySelector('input[name="filtragem_pedidos"]:checked')) {
                    document.getElementById("filtrar").submit();
                }
            }
        </script>

        <script>
            const campos = document.querySelectorAll('.abrir_modal');
            
            const idModal = document.querySelector('.idClienteInfo');
            const nomeClienteModal = document.querySelector('.nomeClienteInfo');
            const telefoneModal = document.querySelector('.telefoneClienteInfo');
            const celularModal = document.querySelector('.celularClienteInfo');

            campos.forEach(campo => {
                campo.addEventListener('click', () => {
                    const valor = JSON.parse(campo.getAttribute('data-valor'));

                    nomeClienteModal.value = valor.nomeCliente;
                    telefoneModal.value = valor.telefone;
                    celularModal.value = valor.celular;
                    idModal.value = valor.idCliente;

                    nomeClienteModal2.value = valor.nomeCliente;
                    telefoneModal2.value = valor.telefone;
                    celularModal2.value = valor.celular;
                    idModal2.value = valor.idCliente;
                });
            });

            const campos2 = document.querySelectorAll('.abrir_modal2');
            
            const idModal2 = document.querySelector('.idClienteExcluir');
            const nomeClienteModal2 = document.querySelector('.nomeClienteExcluir');
            const telefoneModal2 = document.querySelector('.telefoneClienteExcluir');
            const celularModal2 = document.querySelector('.celularClienteExcluir');
            
            campos2.forEach(campo => {
                campo.addEventListener('click', () => {
                    const valor = JSON.parse(campo.getAttribute('data-valor'));

                    nomeClienteModal.value = valor.nomeCliente;
                    telefoneModal.value = valor.telefone;
                    celularModal.value = valor.celular;
                    idModal.value = valor.idCliente;

                    nomeClienteModal2.value = valor.nomeCliente;
                    telefoneModal2.value = valor.telefone;
                    celularModal2.value = valor.celular;
                    idModal2.value = valor.idCliente;
                });
            });
            
        </script>



</body>

</html>