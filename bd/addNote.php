<?php
require_once('conf.php');
session_start();
$idViagem = filter_input(INPUT_GET, 'id');
$idUser = $_SESSION['user_id'];
$tituloNota = filter_input(INPUT_POST, 'tituloNota');
$categoriaNota = filter_input(INPUT_POST, 'categoriaNota');
$dataNota = filter_input(INPUT_POST, 'dataNota');
$valorNota = filter_input(INPUT_POST, 'valorNota');

if (isset($_FILES['nota'])) {
    $arquivo = $_FILES['nota'];

    if ($arquivo['error'])
        header('Location: /teste.php');

    if ($arquivo['size'] > 2097152)
        die('arquivo muito grande!!');

    $pasta = "../notas/";
    $nomeDoArquivo = $arquivo['name'];
    $novoNome = uniqid();
    $extensao = strTOlower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    $path = $pasta . $novoNome . "." . $extensao;
    move_uploaded_file($arquivo["tmp_name"], $path);
}

$sql = $pdo->prepare("INSERT INTO notas (fk_viagem_id , fk_usuario_id , titulo_notas, categoria_notas, data_notas, valor_notas, path_notas) 
VALUES (:idViagem, :idUser, :tituloNota, :categoriaNota, :dataNota, :valorNota, :nota)");
$sql->bindValue(':idViagem', $idViagem);
$sql->bindValue(':idUser', $idUser);
$sql->bindValue(':tituloNota', ucfirst($tituloNota));
$sql->bindValue(':categoriaNota', ucfirst($categoriaNota));
$sql->bindValue(':dataNota', $dataNota);
$sql->bindValue(':valorNota', $valorNota);
$sql->bindValue(':nota', $path);

$sql->execute();

header("Location: ../viagem.php?id=$idViagem&pg=notas");
