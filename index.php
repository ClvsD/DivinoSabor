<?php

session_start();

require_once('./config/Conexao.php');
require_once('./dao/FuncionarioDao.php');
require_once('./model/Funcionario.php');

$funcionario = new Funcionario();
$funcionariodao = new FuncionarioDao();

$login = new FuncionarioDao();

if (!$login->checkLogin()) {
    header("Location: views/login");
}

foreach ($funcionariodao->funcionario() as $funcionario) {

    if ($funcionario->getTipo() == "Gerente") {
        header("Location: views/users/admin/");
    } else {
        header("Location: views/users/funcionario/");
    }
}

?>