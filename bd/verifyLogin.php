<?php 
if (!isset($_SESSION['user_logado']) || $_SESSION['user_logado'] == false) {
  header('Location: ../index.php');
}

?>