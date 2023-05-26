<?php
session_start();

if (isset($_SESSION['admin'])) {
  header('Location: ./popis.php');
}

if (isset($_SESSION['superadmin'])) {
  header('Location: ./dodavanje_admina.php');
}

include('./db.php');
include('./funkcije.php');
$done = false;
$errors = false;

if (isset($_POST['submit_btn'])) {
  $user = $_POST['user'];
  $password = md5($_POST['password']);

  if (checkPassword($user, $password, $conn)) {
    $done = true;
    if (checkIfSuperAdmin($user, $conn)) {
      $_SESSION['superadmin'] = true;
      header("Refresh:2 ; URL=./dodavanje_admina.php");
    } else {
      $_SESSION['admin'] = true;
      header("Refresh:2 ; URL=./popis.php");
    }
  } else {
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