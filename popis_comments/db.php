<?php 
  // povezivanje na bazu, ovde se povezujemo na bazu podataka "popis"
  $server = 'localhost';
  $user = 'root';
  $pw = '';
  $db = 'popis';
  $conn = new mysqli($server, $user, $pw, $db);

  if($conn->connect_error) { 
    echo $conn->connect_error;
    die();
  }
?>