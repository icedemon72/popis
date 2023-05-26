<?php
// pokrecemo sesiju
session_start();

// ako su vec podesene sesije onda je korisnik vec ulogovan, tkd. ne treba
// da pristupi login panelu, bice poslat u zavisnosti od njegove uloge na odgovarajucu
// stranicu (admin na popis, superadmin na dodavanje admina)
if (isset($_SESSION['admin'])) {
  header('Location: ./popis.php');
}

if (isset($_SESSION['superadmin'])) {
  header('Location: ./dodavanje_admina.php');
}

// ukljucujemo dva fajla
include('./db.php');
include('./funkcije.php');

// done -> zavrseno, takodje i errors su sada false
$done = false;
$errors = false;

// ako je kliknuto 'submit_btn' dugme
if (isset($_POST['submit_btn'])) {
  // korisnicko ime
  $user = $_POST['user'];
  // lozinka enkriptovana md5 algoritmom
  $password = md5($_POST['password']);

  // ukoliko je tacna lozinka prilikom prijavljivanja
  if (checkPassword($user, $password, $conn)) {
    // stavljamo da je zavrsen proces, da bi se ispisala "uspesna prijava" poruka
    $done = true;
    
    // proveravamo da li je tek ulogovani korisnik superadmin
    if (checkIfSuperAdmin($user, $conn)) {
      // ukoliko jeste stavljamo da je sesija superadmin tacna
      $_SESSION['superadmin'] = true;
      // korisnik ce biti prebacen na dodavanje_admina.php za 2 sekunde
      header("Refresh:2 ; URL=./dodavanje_admina.php");
    } else {
      // ukoliko korisnik nije superadmin, a tacna mu je lozinka znaci da je admin
      $_SESSION['admin'] = true;
      header("Refresh:2 ; URL=./popis.php");
    }
  } else {
    // ukoliko nije tacna sifra ili korisnicko ime bice ispisana ova poruka
    $errorMessage = 'Pogrešne login informacije!';
    $errors = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Uloguj se!</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
  <div class="d-flex align-items-center justify-content-center vh-100">
    <div class="col-lg-4 col-md-6 col-sm-10" id="forma">
      <div class="brand">
        <h1 class="text-center">PRIJAVA</h1>
      </div>
      <form method="POST">
        <label class="form-label" for="user">Korisničko ime:</label>
        <input class="form-control" type="user" id="user" name="user" required />

        <label class="form-label" for="password">Lozinka:</label>
        <input class="form-control" type="password" id="password" name="password" />

        <input class="btn btn-primary sbm_btn w-100 mt-3" type="submit" value="Prijavi se!" name="submit_btn" class="btn" />
      </form>
      <?php if ($done) : ?>
        <div>
          <p class="correct">Uspešna prijava!</p>
        </div>
      <?php endif; ?>

      <?php if ($errors) : ?>
        <div>
          <p class="errors"><?php echo $errorMessage; ?></p>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <script src="./bootstrap.bundle.min.js"></script>
</body>

</html>