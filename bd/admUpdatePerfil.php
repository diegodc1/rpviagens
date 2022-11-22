<?php

require_once('conf.php');
session_start();


$name = filter_input(INPUT_POST, 'inputName');
$email = filter_input(INPUT_POST, 'inputEmail');
$phone = filter_input(INPUT_POST, 'inputPhone');
$cpf = filter_input(INPUT_POST, 'inputCpf');
$userUpOffice = filter_input(INPUT_POST, 'inputOffice');
$userUpSector = filter_input(INPUT_POST, 'inputSector');
$userUpUnity = filter_input(INPUT_POST, 'inputUnity');
$userUpAccess = filter_input(INPUT_POST, 'inputType');
$id = $_GET['id'];

if (!empty($name) && !empty($email) && !empty($phone) && !empty($cpf)) {
    $sql = $pdo->prepare("UPDATE `usuarios` SET `nome` = :name, `email` = :email, `acesso` = :access, `cpf` = :cpf, `telefone` = :phone, `cargo` = :office, `setor` = :sector, `unidade` = :unity WHERE `usuarios`.`id` = :id");
    $sql->bindValue(':name', $name);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':access', $userUpAccess);
    $sql->bindValue(':cpf', $cpf);
    $sql->bindValue(':phone', $phone);
    $sql->bindValue(':office', $userUpOffice);
    $sql->bindValue(':sector', $userUpSector);
    $sql->bindValue(':unity', $userUpUnity);
    $sql->bindValue(':id', $id);


    $sql->execute();

    $_SESSION['update_success'] = true;
    header("Location: changeUser.php?id=$id&cod=true");
} else {
    $_SESSION['update_success'] = false;
}

