<?php
require_once('conf.php');

session_start();

$info = [];
$user_email = filter_input(INPUT_POST, 'userEmail', FILTER_VALIDATE_EMAIL);
$user_password = md5(filter_input(INPUT_POST, 'userPassword'));

$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
$sql->bindValue(':email', $user_email);
$sql->bindValue(':senha', $user_password);

$sql->execute();
$userInfo = $sql->fetch(PDO::FETCH_ASSOC);


if ($sql->rowCount() > 0) {
  $_SESSION['user_logado'] = true;
  $_SESSION['user_name'] = $userInfo['nome'];
  $_SESSION['user_id'] = $userInfo['id'];
  $_SESSION['user_email'] = $userInfo['email'];
  $_SESSION['user_access'] = $userInfo['acesso'];
  $_SESSION['user_cpf'] = $userInfo['cpf'];
  $_SESSION['user_phone'] = $userInfo['telefone'];
  $_SESSION['user_cargo'] = $userInfo['cargo'];
  $_SESSION['user_sector'] = $userInfo['setor'];
  $_SESSION['user_unity'] = $userInfo['unidade'];
  $_SESSION['user_img'] = $userInfo['path_img'];

  header('Location: ../home.php');
  debug_to_console($userInfo['email']);
} else {
  header('Location: ../index.php');
  $_SESSION['erro_message'] = true;
  $_SESSION['user_logado'] = false;;

}




function debug_to_console($data)
{
  $output = $data;
  if (is_array($output))
    $output = implode(',', $output);
  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
