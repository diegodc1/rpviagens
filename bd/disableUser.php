<?php
if (!empty($_GET['id'])){
    $nome = $_GET['nome']; 
    $id = $_GET['id'];
    include_once('conf.php');

    $sqlSelect = "SELECT *  FROM usuarios WHERE id= $id";
    $result = $pdo->query($sqlSelect);
    $dados = $result->fetch(PDO::FETCH_ASSOC);

    if ($result->rowCount() > 0) {
        if($dados['status'] == 'Ativo'){
        $sqlDelete = "UPDATE usuarios SET status = 'Inativo' WHERE id=$id";
        $resultDelete = $pdo->query($sqlDelete);
        $Message = "<p class='AvisoErro'> Usuário <label class='TextAviso'>$nome</label> foi DESATIVADO com sucesso!</p>";}
        else{
            $sqlDelete = "UPDATE usuarios SET status = 'Ativo' WHERE id=$id";
            $resultDelete = $pdo->query($sqlDelete);
            $Message = "<p class='Aviso'> Usuário <label class='TextAviso'>$nome</label> foi ATIVADO com sucesso!</p>";}   
        }
    }
else {
    $Message = "<p class='AvisoErro'> Houve Algum Erro!</p>";
}
header("location: ../listUsers.php?msg=$Message");
