<?php

    error_reporting(0);

    session_start();

    require_once('../../../config/Conexao.php');
    require_once('../../../model/Funcionario.php');
    require_once('../../../dao/FuncionarioDao.php');
    require_once('../../../model/Cliente.php');
    require_once('../../../dao/ClienteDao.php');
    require_once('../../../model/Ticket.php');
    require_once('../../../dao/TicketDao.php');

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
        <script async src="modal.js"></script>

        <!-- AOS ANIMATE -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <!-- AOS ANIMATE -->

  
        <script src="https://kit.fontawesome.com/b9abc5f66a.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <title>ADM - Tickets</title>
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
            background-image: url("../../../img/<?php echo $funcionariodao->retornaImagem(); ?>");
        }
    </style>


    <div>
        <section id="black_screen_MSL" onclick="Exibir_MSL()"></section>

        <!-- Menu sanduiche lateral -->
        <aside id="menu_sanduiche_left">
            <div class="container_MSL cursor_pointer">
                <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-bookmark icon_size_02"></i> </div>
                <div class="text_space_01" onclick="go_to_page('GestaoTickets')"> <label class="cursor_pointer font_backup_02" style="color:red"> Tickets </label> </div>
            </div>

            <div class="container_MSL cursor_pointer">
                <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-id-badge icon_size_02"></i> </div>
                <div class="text_space_01" onclick="go_to_page('GestaoFuncionarios')"> <label class="cursor_pointer font_backup_02"> Gestão de Funcionários </label> </div>
            </div>

            <div class="container_MSL cursor_pointer">
                <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-user icon_size_02"></i> </div>
                <div class="text_space_01" onclick="go_to_page('GestaoClientes')"> <label class="cursor_pointer font_backup_02"> Gestão de clientes </label> </div>
            </div>

            <div class="container_MSL cursor_pointer">
                <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-chart-bar icon_size_02"></i> </div>
                <div class="text_space_01" onclick="go_to_page('Relatorios')"> <label class="cursor_pointer font_backup_02"> Relatórios </label> </div>
            </div>

            <a href="../../../controller/FuncionarioController.php?logout=true" style="text-decoration: none; color: inherit;">
                <div class="container_MSL cursor_pointer">
                    <div class="icon_space_02"> <i class="cursor_pointer fa-solid fa-arrow-right-from-bracket  icon_size_02"></i> </div>
                    <div class="text_space_01" onclick="logoff()"> <label class="cursor_pointer font_backup_02"> Deslogar </label> </div>
                </div>
            </a>
        </aside> 
        <!-- Menu sanduiche lateral -->

        <!-- Modal Excluir -->
        <div class="modal fade" id="ExcluirModal" tabindex="-1" aria-labelledby="ExcluirModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja Excluir esse ticket?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <ul>
                <form action="../../../controller/TicketController.php" method="post">
                  <li> Pedido: #<label class="id_exclusao">  </label> </li>
                  <li> Status: <label class="status_exclusao">  </label> </li>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancelar <i class="fa-solid fa-ban"></i></button>
                
                    <input type="number" value="" id="id_del" name="id_deletar" class="id_del"/>
                    <button type="submit" class="btn btn-danger" name="excluir" value=""> Excluir <i class="fa-solid fa-trash"></i> </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Excluir -->

        <main id="main">

            <article id="art">
                <section id="secTitle">
                    <h2 data-aos="fade-right" data-aos-duration="1500" >Gestão de Tickets <i class="fa-solid fa-bookmark fa-bounce" style="color: #fe6262;"></i> </h2>
                    <p data-aos="fade-right" data-aos-duration="2000">Gerenciador de abertura de tickets dos funcionários</p>
                </section>
                <button id="btn" onclick="go_to_page('NovoTicket')">+ Novo Ticket</button>
            </article>

            <article id="art2">
                <section>
                    <h2>Filtros</h2>
                    <div class="btn-group" id="dropdown-filter">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Categoria
                        </button>
                        <ul class="dropdown-menu">
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="filtrar" method="post">
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_tickets" onclick="acionarFiltros()" value="1" for="Cancelado" /> Cancelado </label> </li>
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_tickets" onclick="acionarFiltros()" value="2" for="Em andamento" /> Em andamento  </label> </li>
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_tickets" onclick="acionarFiltros()" value="3" for="Concluido" /> Concluido </label> </li>
                        </form>
                        </ul>
                    </div>
                </section>
                <section id="secLimpar">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="filtrar" method="post">
                    <input type="number" name="filtragem_tickets" value="5" hidden>
                    <button type="submit" id="btnLimpar">x Limpar Filtro</button>
                </form>
                </section>
                
            </article>

            <article id="artTitles">
                <section class="secTable"><p>Funcionário</p></section>
                <section class="secTable"><p>Cliente</p></section>
                <section class="secTable"><p>Entrega</p></section>
                <section class="secTable"><p>Valor</p></section>
                <section class="secTable"><p>Status</p></section>
                <section class="secTable"><p>Opções</p></section>
            </article>

            <article id="artCards">
                <?php foreach($ticketdao->listagemFiltros() as $ticket) : ?>
                <section class="cards"> <!-- foreach aqui  -->
                    <section class="secTable" title="<?= $ticket->getNome_Funcionario() ?>" ><h5><?= $ticket->getNome_Funcionario() ?></h5></section>
                    <section class="secTable" title="<?= $ticket->getNome_Cliente() ?>"><h5><?= $ticket->getNome_Cliente() ?></h5></section>
                    <section class="secTable" title="<?=  date('d/m/Y', strtotime($ticket->getDataEntrega())) ?>"><h5><?=  date('d/m/Y', strtotime($ticket->getDataEntrega())) ?></h5></section>
                    <section class="secTable" title="<?= 'R$ ' . number_format($ticket->getValor_Final(), 2, ',', '.') ?>"><h5><?= 'R$ ' . number_format($ticket->getValor_Final(), 2, ',', '.') ?></h5></section>
                    <section class="secTable" title="<?= $ticket->getStatus() ?>"><h5 class="colorStatus"><?= $ticket->getStatus() ?></h5></section>
                    <section class="secTable dFlex">
                    <div class="btn-group dropup float-end mt-2 me-3 ">
                        
                        <button class="elipsis-fix" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical fa-xl rotate cPointer colorIcon"></i>
                        </button>

                        <ul class="dropdown-menu">
                        <form action="../../editar_ticket/index.php" method="post" id="editarForm">
                                <input type="hidden" id="id_edit" name="id_edit" value="<?= $ticket->getID() ?>" /> 
                                <li> <button type="submit" name="editar"> <a class="dropdown-item"> <i class="fa-solid fa-pen"></i> Editar Ticket </a> </button></li>
                                </form>
                                <li> <a class="abrir_exclusao dropdown-item" data-bs-toggle="modal" data-bs-target="#ExcluirModal" data-valor='<?php echo json_encode(array("statusExcluir" => $ticket->getStatus(), "id_ticket" => $ticket->getID())); ?>'> <i class="fa-solid fa-trash"></i> Excluir Ticket </a></li>
                        </ul>
                    </div>
                          
                    </section>  
                </section>

                <?php endforeach ?>
            </article>
        </main>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    </body>
    
    <script>

        function acionarFiltros(){
            if (document.querySelector('input[name="filtragem_tickets"]:checked')){
                document.getElementById("filtrar").submit();
            }
        }   


        //--------------------Exlusao de Tickets Início------------------

    const camposExcluir = document.querySelectorAll('.abrir_exclusao');
    
    const idExcluir = document.querySelector('.id_exclusao');
    
    const statusExclusao = document.querySelector('.status_exclusao');
    
    const idDel = document.querySelector('.id_del');
    

    camposExcluir.forEach(campoExcluir => {
        campoExcluir.addEventListener('click', () => {
        const valor_excluir = JSON.parse(campoExcluir.getAttribute('data-valor'));
        console.log(valor_excluir);
        idExcluir.innerText = valor_excluir.id_ticket;
        statusExclusao.innerText = valor_excluir.statusExcluir;
        idDel.value = valor_excluir.id_ticket;

        });
    });
    //--------------------Exlusao de Tickets Fim---------------------

    </script>

<script>
  AOS.init();
</script>

</html>