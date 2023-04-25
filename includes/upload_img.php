<?php

// Se a imagem estiver sido selecionada
if (!empty($imagem["name"])) {

    // Largura máxima em pixels
    $largura = 3840;
    // Altura máxima em pixels
    $altura = 2160;
    // Tamanho máximo do arquivo em bytes
    $tamanho = 5000000;

    $error = array();

    // Verifica se o arquivo é uma imagem
    if (!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $imagem["type"])) {
        $error[1] = "Isso não é uma imagem.";
    }

    // Pega as dimensões da imagem
    $dimensoes = getimagesize($imagem["tmp_name"]);

    // Verifica se a largura da imagem é maior que a largura permitida
    if ($dimensoes[0] > $largura) {
        $error[2] = "A largura da imagem não deve ultrapassar " . $largura . " pixels";
    }

    // Verifica se a altura da imagem é maior que a altura permitida
    if ($dimensoes[1] > $altura) {
        $error[3] = "Altura da imagem não deve ultrapassar " . $altura . " pixels";
    }

    // Verifica se o tamanho da imagem é maior que o tamanho permitido
    if ($imagem["size"] > $tamanho) {
        $error[4] = "A imagem deve ter no máximo 5MB";
    }

    // Gera um nome único para a imagem
    $num = rand();
    $imagem_user = substr($imagem["name"], -4);
    $nome_imagem = $nomep . '_' . $num . $imagem_user;

    // Caminho de onde ficará a imagem
    $caminho_imagem = "../img/" . $nome_imagem;

    if (file_exists($caminho_imagem)) {
        $error[5] = "Error!! Já Existe um arquivo com este nome ou este arquivo é inválido!!!";
    }

    // Se não houver nenhum erro
    if (count($error) == 0) {

        // Faz o upload da imagem para seu respectivo caminho
        move_uploaded_file($imagem["tmp_name"], $caminho_imagem);

    }

    // Se houver mensagens de erro, exibe-as
    if (count($error) != 0) {
        foreach ($error as $erro) {
            echo '<script type="text/javascript">';
            echo 'alert("' . $erro . '");';
            echo '</script>';
        }
        echo '<script type="text/javascript">';
        echo 'location.href="../views/cadastro_funcionario/index.php";';
        echo '</script>';
    }
}

?>