<?php
require_once('conf.php');
session_start();

if (isset($_FILES['updatearquivo'])) {
  $arquivo = $_FILES['updatearquivo'];
  
  if ($arquivo['error'])
  header('Location: /perfil.php');
  
  if ($arquivo['size'] > 2097152)
  die('arquivo muito grande!!');
  
  unlink($_SESSION['user_img']);
  
  $pasta = "../imgs/";
  $nomeDoArquivo = $arquivo['name'];
  $novoNome = uniqid();
  $extensao = strTOlower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
  $path = $pasta . $novoNome . "." . $extensao;
  move_uploaded_file($arquivo["tmp_name"], $path);
  
  $id = $_SESSION['user_id'];
  $sql = $pdo->prepare("UPDATE usuarios SET path_img = '$path' WHERE id = $id");
  $sql->execute();
  
  $_SESSION['user_img'] = $path;
  echo "<script>parent.self.location=\"../perfil.php\"</script>";
}


if (isset($_FILES['arquivo'])) {
  $arquivo = $_FILES['arquivo'];
  
  if ($arquivo['error'])
  header('Location: /pefil.php');
  
  if ($arquivo['size'] > 2097152)
  die('arquivo muito grande!!');
  
  $pasta = "./imgs/";
  $nomeDoArquivo = $arquivo['name'];
  $novoNome = uniqid();
  $extensao = strTOlower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
  $lastId = $_GET['id'];
  

  $path = $pasta . $novoNome . "." . $extensao;
  
  
  $id_usuario = $_SESSION['user_id'];
  $sql = $pdo->query("UPDATE upload SET upload.path = $path WHERE id_usuario = $id_usuario");
  unset($_GET['id']);
}



$email = filter_input(INPUT_POST, 'inputEmail');
$userId = $_SESSION['user_id'];
$phone = filter_input(INPUT_POST, 'inputPhone');
$photo = filter_input(INPUT_POST, 'inputEmail');

$sql = $pdo->prepare("UPDATE `usuarios` SET `email` = :email, `telefone` = :phone WHERE `usuarios`.`id` = :id");
$sql->bindValue(':email', $email);
$sql->bindValue(':phone', $phone);
$sql->bindValue(':id', $userId);

echo "caiu if 2";

$sql->execute();
$_SESSION['user_email'] = $email;
$_SESSION['user_phone'] = $phone;

header("Location: ../perfil.php");
exit;