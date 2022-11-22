<?php 
include_once('conf.php');

if (!empty($_GET['id'])){
  $idTravel = $_GET['id'];
  $status = 'Desativada';
  $nomeViagem = $_GET['nome'];

  $sql = $pdo->prepare("UPDATE `viagens` SET `status_viagem` = :status WHERE `viagem_id` = :idTravel");
  $sql->bindValue(':status', $status);
  $sql->bindValue(':idTravel', $idTravel);
  $sql->execute();
  $Message = "<p class='AvisoErro'> Viagem <label class='TextAviso'>$nomeViagem</label> foi DESATIVADA com sucesso!</p>";
  header("Location: ../listTravels.php?msg=$Message");
}
