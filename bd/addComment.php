<?php
require_once('conf.php');
session_start();

$commentTitle = filter_input(INPUT_POST, 'inputTitleComment');
$commentText = filter_input(INPUT_POST, 'inputTextComment');
$idUser = $_SESSION['user_id'];
$idViagem = $_GET['idViagem'];
echo $idUser;
echo $commentText;
echo $commentTitle;
echo $idViagem;

$sql = $pdo->prepare("INSERT INTO comentarios (titulo_comentario, texto_comentario, user_id_fk, viagem_id_fk) VALUES (:titulo, :texto, :id_user, :id_viagem)");
$sql->bindValue(':texto',ucfirst($commentText));
$sql->bindValue(':titulo',ucfirst($commentTitle));
$sql->bindValue(':id_user', $idUser);
$sql->bindValue(':id_viagem', $idViagem);

$sql->execute();

header("Location: ../viagem.php?id=$idViagem&pg=comentarios");
