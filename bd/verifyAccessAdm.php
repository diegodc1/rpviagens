<?php 
if ($_SESSION['user_access'] == 0) {
  header('Location: ../home.php');
}
