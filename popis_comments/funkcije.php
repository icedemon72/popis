<?php
  // funkcija koja testira da li korisnik postoji na osvnovu $user (korisnickog imena) i $email (email adrese)
  function userExists($user, $email, $conn) {
    $res = $conn->query("SELECT ime, email FROM administratori WHERE ime = '$user' OR email = '$email'");
    return $res->num_rows == 1;
  }

  // funkcija koja testira da li se poklapaju korisnicko ime i lozinka (ovo se koristi za login)
  function checkPassword($user, $password, $conn) {
    $res = $conn->query("SELECT * FROM administratori WHERE ime = '$user' AND lozinka = '$password'");
    return $res->num_rows == 1;
  }

  // funckija koja proverava da li u bazi stoji da je administrator glavni (tj. da li je 'glavni' jednak 1)
  function checkIfSuperAdmin($user, $conn) {
    $res = $conn->query("SELECT ime FROM administratori WHERE ime = '$user' AND glavni = 1");
    return $res->num_rows == 1;
  }
?>