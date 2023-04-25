<?php

error_reporting(0);

session_start();

include('../../config/Conexao.php');
include('../../dao/FuncionarioDao.php');
include('../../model/Funcionario.php');

$funcionario = new Funcionario();
$funcionariodao = new FuncionarioDao();


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
    <link rel="stylesheet" href="styles.css">
    <script src="gestao_funcionarios_adm.js"></script>


    <script src="https://kit.fontawesome.com/b9abc5f66a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <title>ADM - Funcionários</title>
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
            <div class="text_space_01" onclick="go_to_page('GestaoTickets')"> <label class="cursor_pointer font_backup_02"> Tickets </label> </div>
        </div>

        <div class="container_MSL cursor_pointer">
            <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-id-badge icon_size_02"></i> </div>
            <div class="text_space_01" onclick="go_to_page('GestaoFuncionarios')"> <label class="cursor_pointer font_backup_02" style="color:#B899FF"> Gestão de Funcionários </label> </div>
        </div>

        <div class="container_MSL cursor_pointer">
            <div class="icon_space_02"> <i class="cursor_pointer fa-regular fa-user icon_size_02"></i> </div>
            <div class="text_space_01" onclick="go_to_page('GestaoClientes')"> <label class="cursor_pointer font_backup_02"> Gestão de clientes </label> </div>
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

    <form action="../../controller/FuncionarioController.php" method="post">
        <!-- Modal Excluir -->
        <div class="modal fade" id="ExcluirModal" tabindex="-1" aria-labelledby="ExcluirModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja Excluir esse ticket?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input name="id_funcionario" class="idFuncionarioExcluir" id="idFuncionarioExcluir" type="text">
                        <br />
                        <input type="text" name="nome" class="nomeFuncionarioExcluir" id="EditNomeFuncionario" disabled placeholder="Nome completo do funcionário ">
                        <p></p>
                        <input type="text" name="cpf" class="cpfFuncionarioExcluir" id="cpfFuncionarioExcluir" disabled placeholder="Cpf">

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

    <main id="main">

        <article id="art">
            <section id="secTitle">
                <h2>Gestão de Funcionários</h2>
                <p>Gerenciador de funcionários da empresa</p>
            </section>
            <a href="../cadastro_funcionario/index.php"><button id="btn">+ Novo Funcionário</button></a>
        </article>

        <article id="art2">
            <section>
                <h2>Filtros</h2>
                <div class="btn-group" id="dropdown-filter">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categoria
                    </button>
                    <ul class="dropdown-menu">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="filtrar" method="post">
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_funcionarios" onclick="acionarFiltros()" value="1" for="Nome" /> Nome <i class="fa-solid fa-arrow-down-z-a"> </i> </label> </li>
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_funcionarios" onclick="acionarFiltros()" value="2" for="Nome" /> Nome <i class="fa-solid fa-arrow-down-a-z"> </i> </label> </li>
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_funcionarios" onclick="acionarFiltros()" value="3" for="Turno" /> Turno <i class="fa-solid fa-arrow-down-z-a"> </i> </label> </li>
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_funcionarios" onclick="acionarFiltros()" value="4" for="Turno" /> Turno <i class="fa-solid fa-arrow-down-a-z"> </i> </label> </li>
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_funcionarios" onclick="acionarFiltros()" value="5" for="Função" /> Função <i class="fa-solid fa-arrow-down-z-a"> </i> </label> </li>
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_funcionarios" onclick="acionarFiltros()" value="6" for="Função" /> Função <i class="fa-solid fa-arrow-down-a-z"> </i> </label> </li>
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_funcionarios" onclick="acionarFiltros()" value="7" for="Salário" /> Salário <i class="fa-solid fa-arrow-down-1-9"></i> </label> </li>
                            <li> <label class="dropdown-item" href="#"><input type="radio" name="filtragem_funcionarios" onclick="acionarFiltros()" value="8" for="Salário" /> Salário <i class="fa-solid fa-arrow-down-9-1"></i> </label> </li>
                        </form>
                    </ul>
                </div>
            </section>
            <section id="secLimpar">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="filtrar" method="post">
                    <input type="number" name="filtragem_funcionarios" value="9" hidden>
                    <button type="submit" id="btnLimpar">x Limpar Filtro</button>
                </form>
            </section>

        </article>

        <article id="artTitles">
            <section class="secTable">
                <p>Funcionário</p>
            </section>
            <section class="secTable">
                <p>Turno</p>
            </section>
            <section class="secTable">
                <p>Função</p>
            </section>
            <section class="secTable">
                <p>Salário</p>
            </section>
            <section class="secTable">
                <p>Opções</p>
            </section>
        </article>

        <article id="artCards">
            <?php foreach ($funcionariodao->listagemFiltros() as $funcionario) : ?>
                <section class="cards">
                    <section class="secTable" title="<?= $funcionario->getNome() ?>">
                        <h5><?= $funcionario->getNome() ?></h5>
                    </section>
                    <section class="secTable" title="<?= $funcionario->getTurno() ?>">
                        <h5><?= $funcionario->getTurno() ?></h5>
                    </section>
                    <section class="secTable" title="<?= $funcionario->getTipo() ?>">
                        <h5><?= $funcionario->getTipo() ?></h5>
                    </section>
                    <section class="secTable" title="<?= 'R$ ' . number_format($funcionario->getSalario(), 2, ',', '.') ?>">
                        <h5><?= 'R$ ' . number_format($funcionario->getSalario(), 2, ',', '.') ?></h5>
                    </section> <!-- colorcar onclick nos icon -->

                    <section class="secTable dFlex">
                        <div class="btn-group dropup float-end mt-2 me-3 ">

                            <button class="elipsis-fix" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical fa-xl rotate cPointer colorIcon"></i>
                            </button>

                            <ul class="dropdown-menu">
                                <form action="../editar_funcionario/index.php" method="post" name="edit">
                                    <input type="hidden" id="id_edit" name="id_edit" value="<?= $funcionario->getID() ?>" />

                                    <li> <button type="submit" name="editar"> <a class="dropdown-item"> <i class="fa-solid fa-pen"></i> Editar dados do funcionário </a></button> </li>
                                </form>
                                <li> <a class="abrir_modal dropdown-item" data-bs-toggle="modal" data-bs-target="#ExcluirModal" data-valor='<?php echo json_encode(array("idFuncionario" => $funcionario->getID(), "nomeFuncionario" => $funcionario->getNome(), "cpfFuncionario" => $funcionario->getCPF())); ?>'> <i class="fa-solid fa-trash"></i> Excluir dados do funcionário </a></li>
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
            if (document.querySelector('input[name="filtragem_funcionarios"]:checked')) {
                document.getElementById("filtrar").submit();
            }
        }
    </script>

    <script>
        const campos = document.querySelectorAll('.abrir_modal');

        const idModal = document.querySelector('.idFuncionarioExcluir');
        const nomeFuncionarioModal = document.querySelector('.nomeFuncionarioExcluir');
        const cpfModal = document.querySelector('.cpfFuncionarioExcluir');

        campos.forEach(campo => {
            campo.addEventListener('click', () => {
                const valor = JSON.parse(campo.getAttribute('data-valor'));

                nomeFuncionarioModal.value = valor.nomeFuncionario;
                cpfModal.value = valor.cpfFuncionario;
                idModal.value = valor.idFuncionario;

            });
        });
    </script>

</body>

</html>