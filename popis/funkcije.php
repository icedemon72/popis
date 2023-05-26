<?php

  function userExists($user, $email, $conn) {
    $res = $conn->query("SELECT ime, email FROM administratori WHERE ime = '$user' OR email = '$email'");
    return $res->num_rows == 1;
  }

  function checkPassword($user, $password, $conn) {
    $res = $conn->query("SELECT * FROM administratori WHERE ime = '$user' AND lozinka = '$password'");
    return $res->num_rows == 1;
  }

  function checkIfSuperAdmin($user, $conn) {
    $res = $conn->query("SELECT ime FROM administratori WHERE ime = '$user' AND glavni = 1");
    return $res->num_rows == 1;
  }
?>