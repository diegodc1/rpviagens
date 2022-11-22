<?php
require_once('conf.php');

session_start();


$name = filter_input(INPUT_POST, 'inputName');
$email = filter_input(INPUT_POST, 'inputEmail');
$password = md5(filter_input(INPUT_POST, 'inputPassword'));
$repeat_password = md5(filter_input(INPUT_POST, 'inputRepeatPassword'));
$cpf = filter_input(INPUT_POST, 'inputCpf');
$phone = filter_input(INPUT_POST, 'inputPhone');
$office = filter_input(INPUT_POST, 'inputOffice');
$sector = filter_input(INPUT_POST, 'inputSector');
$unity = filter_input(INPUT_POST, 'inputUnity');
$access = filter_input(INPUT_POST, 'inputType');
$status = 'Ativo';

$sql = $pdo->prepare("SELECT * FROM usuarios WHERE cpf = :cpf");
$sql->bindValue(':cpf', $cpf);
$sql->execute();


  if ($sql->rowCount() == 0) {
  if ($password == $repeat_password) {
    if (validaCPF($cpf)) {
        if (isset($_FILES['arquivo'])) {
          $arquivo = $_FILES['arquivo'];
      
          if ($arquivo['error'])
              header('Location: ../cadUsers.php');
      
          if ($arquivo['size'] > 2097152)
              die('arquivo muito grande!!');
      
          $pasta = "../imgs/";
          $nomeDoArquivo = $arquivo['name'];
          $novoNome = uniqid();
          $extensao = strTOlower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));    
          $path = $pasta . $novoNome . "." . $extensao; 
          move_uploaded_file($arquivo["tmp_name"], $path);

          $sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, acesso, cpf, telefone, cargo, setor, unidade, path_img, status) VALUES (:name, :email, :password, :access, :cpf, :phone, :office, :sector, :unity, '$path', :status)");

        $sql->bindValue(':name', ucwords($name));
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->bindValue(':cpf', $cpf);
        $sql->bindValue(':phone', $phone);
        $sql->bindValue(':office', $office);
        $sql->bindValue(':sector', $sector);
        $sql->bindValue(':unity', $unity);
        $sql->bindValue(':access', $access);
        $sql->bindValue(':status', $status);

        $sql->execute();
        $lastId = $pdo->lastInsertId();
        header("Location: ../cadUsers.php?cod=true");
        exit;
      } else {
        header("Location: ../cadUsers.php?cod=imgError");
        echo "CPF Inválido";
      }
    } else {
      header("Location: ../cadUsers.php?cod=cpfError");
    }
  } else {
    header("Location: ../cadUsers.php?cod=passError");
  }
} else {
  header("Location: ../cadUsers.php?cod=userError");
};


// Validação de CPF
function validaCPF($cpf)
{
  // Extrai somente os números
  $cpf = preg_replace('/[^0-9]/is', '', $cpf);

  // Verifica se foi informado todos os digitos corretamente
  if (strlen($cpf) != 11) {
    return false;
  }

  // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
  if (preg_match('/(\d)\1{10}/', $cpf)) {
    return false;
  }

  // Faz o calculo para validar o CPF
  for ($t = 9; $t < 11; $t++) {
    for ($d = 0, $c = 0; $c < $t; $c++) {
      $d += $cpf[$c] * (($t + 1) - $c);
    }
    $d = ((10 * $d) % 11) % 10;
    if ($cpf[$c] != $d) {
      return false;
    }
  }
  return true;
}
  ?>

