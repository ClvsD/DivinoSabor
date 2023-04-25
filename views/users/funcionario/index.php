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

if(!$login->checkLogin()) {
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap -->

    <!-- Script e CSS da página-->
    <link rel="stylesheet" href="modal.css">
    <link rel="stylesheet" href="style_funcionario.css">
    <script async src="modal.js"></script>
    <!-- Script e CSS da página-->


    <title> DS - Meus Tickets </title>

    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/2db99d343f.js" crossorigin="anonymous"></script>
    <!-- FONT AWESOME -->

    <!-- AOS ANIMATE -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- AOS ANIMATE -->

    <!--Esses três links são responsáveis por fazer a caixa de pesquisa pesquisável-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!--Esses três links são responsáveis por fazer a caixa de pesquisa pesquisável-->

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

        <section id="agroupPerfil">
            <label class="name_logado"> <?php echo $funcionariodao->retornaNome(); ?> </label>
        
        
            <section id="user_logo">
            </section>
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
                <div class="text_space_01" onclick="go_to_page('Logo')"> <label class="cursor_pointer font_backup_02" style="color:red" > Tickets </label> </div>
            </div>

            <a href="../../../controller/FuncionarioController.php?logout=true"
                style="text-decoration: none; color: inherit;">
                <div class="container_MSL cursor_pointer">
                    <div class="icon_space_02"> <i
                            class="cursor_pointer fa-solid fa-arrow-right-from-bracket  icon_size_02"></i> </div>
                    <div class="text_space_01" onclick="logoff()"> <label class="cursor_pointer font_backup_02">
                            Deslogar </label> </div>
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
                <form action="../../../controller/TicketController.php" method="post" name="excluir">
                  <li> Pedido: #<label class="id_exclusao">  </label> </li>
                  <li> Nome do Cliente: <label class="nome_cliente_excluir">  </label> </li>
                  <li> Entrega: <label class="entrega_exlcusao">  </label> </li>
                  <li> Status: <label class="status_exclusao">  </label> </li>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancelar <i class="fa-solid fa-ban"></i></button>
                    <input type="number" value="" name="id_deletar" class="id_del"/>
                    <button type="submit"  class="btn btn-danger" name="excluir" value=""> Excluir <i class="fa-solid fa-trash"></i> </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Excluir -->

        <!-- Modal Info Ticket -->
        <div class="modal fade" id="ModalInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Informações do ticket</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                
                    <section id="info_ticket_left"> 
                    

                    <div id="container_01" class="rounded-top-1 rounded-end-0">
                            <div> <label class="nome_cliente_info texto_ticket"> <i class="fa-regular fa-user "></i> Nome completo do cliente </label> </div>
                        </div>

                        <div id="container_01" class="border-top-0"> 
                            <div> <label class="endereco_info texto_ticket"> <i class="fa-regular fa-map "></i> Endereço completo do cliente </label> </div>
                        </div>

                        <div id="container_01" class="border-top-0"> 
                            <div> <label class="telefone_info texto_ticket"> <i class="fa-regular fa-comments "></i> (31) 9 0000-0000 / (31) 0000-0000 </label> </div>
                        </div>

                        <div id="container_01" class="border-top-0"> 
                            <div> <label class="data_info texto_ticket"> <i class="fa-regular fa-calendar-days "></i> 31/12/2000 (00:00) - 01/01/2001 (12:00) </label> </div>
                        </div>

                        <div id="container_01" class="border-top-0"> 
                            <div> <label class="valor_info texto_ticket"> <i class="fa-regular fa-dollar-sign "></i> R$ 1599,00 </label> </div>
                        </div>

                        <div id="container_01" class="border-top-0 rounded-start-1 rounded-top-0"> 
                            <div> <label class="status_info texto_ticket"> <i class="fa-regular fa-bookmark "></i> Em Andamento </label> </div>
                        </div>

                    </section>
    
    
                    <section id="info_ticket_right"> 
                        <div id="container_01" class="border-start-0 rounded-end rounded-bottom-0"> 
                            <!--<button class="plano_text_03" data-bs-target="#DetalhesPacote" data-bs-toggle="modal" > <i class="fa-solid fa-info" ></i> </button>-->
                            <div class="plano_text_01"> <label> PACOTE: </label></div>
                            <div > <label class="nome_pacote_info plano_text_02" title=""> titulo produto </label></div>
                        </div>
    
                        <div id="container_02"> 
                            <label class="plano_text_05"> OBSERVAÇÃO </label>
                        </div>
    
                        <div id="container_03"> 
                            <label class="observacao_info plano_text_06"> 
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultrices sed mauris placerat dapibus. Fusce eu scelerisque quam, ac luctus est. Donec pharetra varius purus sed tincidunt. Donec condimentum tortor eget nisl posuere placerat. Etiam diam risus, rhoncus eget mauris non, rutrum pretium lorem. Sed facilisis scelerisque ultricies. Duis non malesuada ipsum, nec suscipit leo. Etiam fermentum ac lectus non efficitur. Phasellus mollis purus leo, commodo pulvinar nibh eleifend non. Aliquam fringilla finibus diam, dictum fermentum massa varius ultrices. Praesent orci est, interdum in finibus sed, aliquam et ligula. Donec posuere varius ultricies. Nunc pulvinar ipsum ac neque maximus, non sollicitudin risus elementum.
                                
                                Nullam in ullamcorper orci. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean vel odio nisl. Maecenas non tristique orci. Phasellus non mi nulla. Duis commodo eros eget elit fringilla sodales. Duis ornare fermentum dolor ac laoreet. Mauris et arcu a nulla tincidunt egestas. Nunc cursus diam ut massa sagittis hendrerit.
                                
                                Nulla hendrerit volutpat purus, eget finibus nunc finibus vel. Nam finibus non magna nec gravida. Phasellus elementum mollis tortor, sit amet cursus orci consequat id. Ut viverra sit amet dui eu egestas. Quisque ullamcorper turpis semper sem pretium, id elementum est blandit. Curabitur vitae vehicula dolor, eget aliquet lorem. Nunc ligula nibh, scelerisque eget sapien vitae, pulvinar facilisis odio.
                                
                                Nunc tellus ex, vestibulum a fringilla nec, vestibulum vitae diam. Nam suscipit venenatis lorem, ut rutrum justo congue vel. Etiam scelerisque semper vulputate. Donec laoreet a libero nec faucibus. Nunc pharetra ante a ultricies sodales. Vestibulum nec efficitur lectus. In ultricies facilisis eros fermentum egestas. Proin consequat erat a nisl congue accumsan. Curabitur at ultricies ex. Proin venenatis est id ex consequat, sed feugiat purus dictum. Sed sit amet gravida augue. Maecenas consectetur orci a eros fermentum sagittis. Sed auctor hendrerit massa. Duis ac scelerisque odio, sit amet bibendum velit. Nam auctor tortor vitae lacinia pellentesque. Phasellus ornare condimentum justo, id luctus sem vehicula eget.
                                
                                Sed malesuada erat non consequat tempor. Sed eu semper mi. Proin dictum nibh vel pretium pellentesque. Suspendisse potenti. Integer volutpat lorem vitae diam lacinia, eget rutrum lorem congue. Nulla placerat, arcu ut aliquam laoreet, enim sapien tempus metus, in fringilla purus odio ut lorem. Vestibulum vel mi non ante gravida imperdiet. Quisque dictum lacus vel magna scelerisque, a tempus ligula luctus. Proin porta iaculis magna, euismod laoreet massa semper vel. Phasellus ut dui velit. Vivamus pharetra nisl quis nulla congue pharetra. Duis id quam tincidunt, pulvinar massa eu, maximus enim. Aenean pretium quis turpis eget ullamcorper. Etiam dignissim felis at pulvinar dictum. 
                            </label>
                        </div>
                    </section>
    
                </section>

                </div>
                
        
              </div>
            </div>
          </div>
        <!-- Modal Info Ticket -->

          
          <!-- Modal Itens do pack  -->
          <div class="modal fade" id="DetalhesPacote" aria-hidden="true" aria-labelledby="DetalhesPacote" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalToggleLabel2"> O que vem neste pacote? </h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Insira o que vem incluso no pacote aqui
                </div>
                <div class="modal-footer">
                  <button class="btn btn-warning" data-bs-target="#ModalInfo" data-bs-toggle="modal"> Retornar </button>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal Itens do pack  -->
        
          
        <!-- Janelas Modal -->
    </div>


    <!-- MAIN -->
    <main id="main">
        <article id="artOpcao">

            <button id="btn" onclick="Exibir_Novo_Ticket('')">
                + Novo Ticket
            </button>
            
                <div class="btn-group" id="dropdown-filter">
                    <button class="btn btn-secondary btn-sm dropdown-toggle fontSize" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Filtrar Ticket
                    </button>
                    <ul class="dropdown-menu">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" id="filtrar" method="post">
                        <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_tickets" onclick="acionarFiltros()" value="1" for="Todos" /> Todos </label> </li>
                        <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_tickets" onclick="acionarFiltros()" value="2" for="Em andamento" /> Em andamento </label> </li>
                        <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_tickets" onclick="acionarFiltros()" value="3" for="Concluído" /> Concluído </label> </li>
                        <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_tickets" onclick="acionarFiltros()" value="4" for="Cancelado" /> Cancelado </label> </li>
                    </form>
                    </ul>
                </div>
            
        </article>

        <article id="artCards">

            <?php foreach ($ticketdao->listInformacoes() as $ticket): ?>
                <!-- Novo Card -->
                <section class="card">
                    <div class="container_ticket mb-4">
                        <label class="font_backup_05 text-center mt-2"> Pedido
                            <?php echo $ticket->getID(); ?>
                        </label>
                    </div>
                    <div class="container_ticket">
                        <label class="font_backup_05 text-center mt-2 " title="<?php echo $ticket->getNome_Cliente();?>"> <i class="fa-solid fa-user me-1"></i>
                            <?php echo $ticket->getNome_Cliente(); ?>
                        </label>
                    </div>
                    <div class="container_ticket">
                        <label class="font_backup_05 text-center mt-2" title="<?= date('d/m/Y', strtotime($ticket->getDataEntrega()));?>"> <i class="fa-solid fa-calendar me-1"></i>
                            <?=  date('d/m/Y', strtotime($ticket->getDataEntrega())); ?>
                        </label>
                    </div>
                    <hr>
                    <div class="container_ticket">
                        <div class="float-start">
                            <?php

                            if ($ticket->getStatus() == "Em andamento") {
                                echo '<label class="font_backup_05 ms-2 float-start"> <i class="fa-solid fa-circle me-1 colorYellow"></i> Em Andamento </label>';
                            } else if ($ticket->getStatus() == "Concluido") {
                                echo '<label class="font_backup_05 ms-2"> <i class="fa-solid fa-circle me-1 colorGreen"></i> Concluido </label>';
                            } else if ($ticket->getStatus() == "Cancelado") {
                                echo '<label class="font_backup_05 ms-2"> <i class="fa-solid fa-circle me-1 colorRed"></i> Cancelado </label>';
                            } else {
                                echo '<label class="font_backup_05 ms-2"> <i class="fa-solid fa-circle me-1 "></i> ? </label>';

                            }

                            ?>
                        </div>

                        

                        <div class="btn-group dropup float-end mt-2 me-3 ">
                            <button class="elipsis-fix" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis fa-xl"></i>
                            </button>
                            <ul class="dropdown-menu">
                            <li><a class="abrir_modal dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalInfo" data-valor='<?php echo json_encode(array("nomeCliente" => $ticket->getNome_Cliente(), "endereco" => $ticket->getEndereco(), "telefoneCliente" => $ticket->getTelefoneCliente() . " / " . $ticket->getCelularCliente(), "data" => $ticket->getDataCriacao() . " - " . $ticket->getDataEntrega(), "valorFinal" => "R$" . $ticket->getValor_Final(), "status" => $ticket->getStatus(), "nomePacote" => $ticket->getNome_Pacote(), "observacao" => $ticket->getObservacao(), "id_ticket" => $ticket->getID())); ?>' > Visualizar Informações <i class="fa-solid fa-circle-info"></i></a>
                            <form action="../../editar_ticket/index.php" method="post" class="editar">
                                <input type="number" id="id_edit" name="id_edit" value="<?= $ticket->getID() ?>"/>   
                            <li><a class="dropdown-item" onclick="enviarEditar()"> Editar Informações <i class="fa-solid fa-pen"></i></a></li>
                            </form> 
                                <li><a class="abrir_exclusao dropdown-item" data-bs-target="#ExcluirModal" data-bs-toggle="modal" data-valor='<?php echo json_encode(array("nomeCliente" => $ticket->getNome_Cliente(), "endereco" => $ticket->getEndereco(), "telefoneCliente" => $ticket->getTelefoneCliente() . " / " . $ticket->getCelularCliente(), "data" => $ticket->getDataCriacao() . " - " . $ticket->getDataEntrega(), "valorFinal" => "R$" . $ticket->getValor_Final(), "statusExcluir" => $ticket->getStatus(), "nomePacote" => $ticket->getNome_Pacote(), "observacao" => $ticket->getObservacao(), "id_ticket" => $ticket->getID(), "data_entregaExcluir" => $ticket->getDataEntrega())); ?>'> Excluir Ticket <i class="fa-solid fa-trash colorRed"></i>
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <form action="../../../controller/TicketController.php" method="post" name="StatusCancelado">
                                <button type="submit" name="StatusCancelado" class="button_fix">
                                    <input type="text" name="id_ticket" class="alterStatus" value="<?= $ticket->getID() ?>" />
                                <li><a class="dropdown-item"> Definir como: <i class="fa-solid fa-circle me-1 fa-sm colorRed"></i> Cancelado </a></li>
                                </button> 
                                </form>

                                <form action="../../../controller/TicketController.php" method="post" name="StatusAndamento">
                                <button type="submit" name="StatusAndamento" class="button_fix">    
                                    <input type="text" name="id_ticket" class="alterStatus" value="<?= $ticket->getID() ?>" />
                                <li><a class="dropdown-item"> Definir como: <i class="fa-solid fa-circle me-1 fa-sm colorYellow"></i> Em Andamento </a></li>
                                </button>
                                </form>

                                <form action="../../../controller/TicketController.php" method="post" name="StatusConcluido">
                                <button type="submit" name="StatusConcluido" class="button_fix">    
                                    <input type="text" name="id_ticket" class="alterStatus" value="<?= $ticket->getID() ?>" />
                                <li><a class="dropdown-item"> Definir como: <i class="fa-solid fa-circle me-1 fa-sm colorGreen"></i> Concluido </a></li>
                                </button>    
                                </form>
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- Novo Card -->

            <!-- Informações para passar pro modal INÍCIO -->   
           
            <?php endforeach ?>


        </article>

    </main>

    <!-- JQUERY TOAST-->
    <script src="jquery-3.6.3.min.js"></script>
    <!-- JS TOAST-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- CSS TOAST -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</body>

<script>
    $(document).ready(function () {
        $('#clientes').select2();
    });
</script>

<script>
    $(document).ready(function () {
        $('#produtos').select2();
    });
</script>

<script>

//----------------------Itens do Pedido Início-----------------

  const campos = document.querySelectorAll('.abrir_modal');
  const nomeClienteModal = document.querySelector('.nome_cliente_info');
  const enderecoModal = document.querySelector('.endereco_info');
  const celularModal = document.querySelector('.celular_info');
  const telefoneModal = document.querySelector('.telefone_info');
  const datasModal = document.querySelector('.data_info');
  const valorModal = document.querySelector('.valor_info');
  const statusModal = document.querySelector('.status_info');
  const nomePacote = document.querySelector('.nome_pacote_info');
  const observacaoInfo = document.querySelector('.observacao_info');
  const id = document.querySelector('.id_exclusao');

  campos.forEach(campo => {
    campo.addEventListener('click', () => {
      const valor = JSON.parse(campo.getAttribute('data-valor'));

      nomeClienteModal.innerText = valor.nomeCliente;
      enderecoModal.innerText = valor.endereco;
      telefoneModal.innerText = valor.telefoneCliente;
      datasModal.innerText = valor.data;
      valorModal.innerText = valor.valorFinal;
      statusModal.innerText = valor.status;
      nomePacote.innerText = valor.nomePacote;
      observacaoInfo.innerText = valor.observacao;
      id.innerText = valor.id_ticket;

    });
  });

//----------------------Itens do Pedido Fim-----------------

</script>

<script>

//--------------------Exlusao de Tickets Início------------------

const camposExcluir = document.querySelectorAll('.abrir_exclusao');
const nomeClienteExcluir = document.querySelector('.nome_cliente_excluir');
const idExcluir = document.querySelector('.id_exclusao');
const dataEntrega = document.querySelector('.entrega_exlcusao');
const statusExclusao = document.querySelector('.status_exclusao');
const idDel = document.querySelector('.id_del');

camposExcluir.forEach(campoExcluir => {
    campoExcluir.addEventListener('click', () => {
      const valor_excluir = JSON.parse(campoExcluir.getAttribute('data-valor'));

      nomeClienteExcluir.innerText = valor_excluir.nomeCliente;
      idExcluir.innerText = valor_excluir.id_ticket;
      dataEntrega.innerText = valor_excluir.data_entregaExcluir;
      statusExclusao.innerText = valor_excluir.statusExcluir;
      idDel.value = valor_excluir.id_ticket;

    });
});
//--------------------Exlusao de Tickets Fim---------------------

function acionarFiltros(){
            if (document.querySelector('input[name="filtragem_tickets"]:checked')){
                document.getElementById("filtrar").submit();
            }
        }  




function definirCancelado(){
    document.getElementById("cancelado").submit();
}

function enviarEditar(){
    if (document.querySelector('input[name="id_edit"]')){
        document.querySelector(".editar").submit();
    }
}  

</script>
<script>
    AOS.init();
</script>

</html>