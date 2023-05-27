<?php 
session_start();

if (isset($_POST['logout'])) {
  unset($_SESSION['superadmin']);
  unset($_SESSION['admin']);
  header('Location: ./index.php');
  exit();
}

?>