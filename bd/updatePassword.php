<?php
session_start();
require_once('conf.php');

$userId = $_SESSION['user_id'];

// echo filter_input(INPUT_POST, 'inputPassword');
// echo filter_input(INPUT_POST, 'inputConfirmPassword');

$password = md5(filter_input(INPUT_POST, 'inputPassword'));
$confirmPassword = md5(filter_input(INPUT_POST, 'inputConfirmPassword'));

if ($password === $confirmPassword) {
    $sql = $pdo->prepare("UPDATE usuarios SET senha = :pass WHERE id = :userId");
    $sql->bindValue(':pass', $password);
    $sql->bindValue(':userId', $userId);
    $sql->execute();

    echo "rodou";
    header("Location: ../perfil.php?status=true");  
} else {
   header("Location: ../perfil.php?status=false");
}
