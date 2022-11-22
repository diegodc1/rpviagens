<?php
session_start();
require_once('conf.php');

$cpf = filter_input(INPUT_POST, 'cpf');
$newSenha = md5(filter_input(INPUT_POST, 'newSenha'));
$repeat = md5(filter_input(INPUT_POST, 'repeat'));

if ($newSenha == $repeat) {
    $sql = $pdo->prepare("UPDATE usuarios SET senha = '$newSenha' WHERE cpf = '$cpf'");
    $sql->execute();
    $senha = $sql->fetch();
    header("Location: ../index.php");
} else {
    $_SESSION['errorSenha'] = true;
    header("Location: ../esqSenha.php");
}
