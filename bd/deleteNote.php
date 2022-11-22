<?php
if (!empty($_GET['id']))
    $nome = $_GET['nome'];
    $id = $_GET['id'];
    $idNota = $_GET['idNota'];
    {
    include_once('conf.php');

    $sqlSelect = "SELECT * FROM notas WHERE id_notas= $idNota";

    $result = $pdo->query($sqlSelect);

    if ($result->rowCount() > 0) {
        $sqlDelete = "DELETE FROM notas WHERE id_notas=$idNota ";
        $resultDelete = $pdo->query($sqlDelete);
        $Message = "<p class='Aviso'> Nota <label class='TextAviso'>$nome</label> foi excluída com sucesso!</p>";
    }
    else {
        $Message = "<p class='AvisoErro'> Nota <label class='TextAvisoErro'>$nome</label> não foi encontrada!</p>";
    }
    header("location: ../viagem.php?id=$id&msg=$Message");
}
