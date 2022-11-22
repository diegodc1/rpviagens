<?php
require_once('conf.php');
session_start();

$users = null;

if(isset($_POST['selectedUsers'])) {
  $users = $_POST['selectedUsers'];
}



if($users !== null) {
  for($i = 0; $i < count($users); $i++) {
    $sql = $pdo->prepare("INSERT INTO usuario_viagem (fk_id_usuario, fk_id_viagem) VALUES (:idUsuario, :idViagem)");
    $sql->bindValue(':idUsuario', $users[$i]);
    $sql->bindValue(':idViagem', $_SESSION['id_viagem']);
    $sql->execute();
    echo "<p>{$users[$i]}</p>";
  }
  unset($_SESSION['id_viagem']);
  header("Location: ../home.php");
} else {
  header("Location: ../perfil.php");
}

?>
