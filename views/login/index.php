<?php

session_start();

require_once('../../config/Conexao.php');
require_once('../../dao/FuncionarioDao.php');
require_once('../../model/Funcionario.php');

$login = new FuncionarioDao();

if ($login->checkLogin()) {
    header("Location: ../../");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>DS - Login</title>
    <script type="text/javascript" src="mask.js"> </script>
</head>

<body>
    <main id="main">
        <article id="artForm">
            <form action="../../controller/FuncionarioController.php" method="post" name="entrar" id="form">

                <section id="logo2"></section>
                <section id="logo3"></section>

                <section id="group">

                    <input type="text" name="cpf" id="cpf" placeholder="Informe o CPF" required />

                    <input type="password" name="senha" placeholder="Informe a senha" required />

                    <input type="submit" id="btn" name="login" value="ENTRAR" />
                </section>
            </form>
        </article>

        <article id="artBg">

        </article>
    </main>
</body>

</html>