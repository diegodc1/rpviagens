<?php
if (!empty($_GET['id']))
    $nome = $_GET['nome']; 
    $id = $_GET['id'];
    {
    include_once('conf.php');

    $sqlSelect = "SELECT *  FROM usuarios WHERE id= $id";

    $result = $pdo->query($sqlSelect);

    if ($result->rowCount() > 0) {
        $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
        $resultDelete = $pdo->query($sqlDelete);
        $Message = "<p class='Aviso'> Usuário <label class='TextAviso'>$nome</label> foi excluído com sucesso!</p>";
    }
    else {
        $Message = "<p class='AvisoErro'> Usuário <label class='TextAvisoErro'>$nome</label> foi excluído com sucesso!</p>";
    }
    header("location: ../listUsers.php?msg=$Message");
}
