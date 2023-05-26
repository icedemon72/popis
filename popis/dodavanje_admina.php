<?php 
  session_start();

  if(!isset($_SESSION['superadmin'])) {
    header('Location: ./index.php');
    exit();
  }

  include('./db.php');
  include('./funkcije.php');

  if(isset($_POST['logout'])) {
    unset($_SESSION['superadmin']);
    header('Location: ./index.php');
  }

  $errors = '';
  $success = false;

  if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $ime = $_POST['ime'];
    $lozinka = md5($_POST['lozinka']);

    if(userExists($ime, $email, $conn)) {
      $errors = 'Administrator već postoji!';
      $success = false;
    } else {
      $sql = "INSERT INTO administratori(ime, email, lozinka) VALUES ('$ime', '$email', '$lozinka')";
      $conn->query($sql);
      $success = true;
    }
    
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dodaj admina!</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="./bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">ePopis</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="./dodavanje_admina.php">Dodaj admina</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./statistika.php">Statistika</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./popis.php">Popis</a>
          </li>
        </ul>
        <div class="nav-item d-flex">
          <form method="post">
            <input class="nav-link" type="submit" value="Izloguj se" name="logout">
          </form>
        </div>
      </div>
    </div>
  </nav>

  <div class="popis_cont container-fluid">
    <h1 class="text-center">Dodaj admina</h1>
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-12">
        <form method="post" id="popisForm">
          <label class="form-label">E-mail:</label>
          <input class="form-control" type="email" name="email" required>
          <div class="mb-3">
            <label class="form-label">Korisničko ime:</label>
            <input class="form-control" type="text" name="ime" aria-describedby="userHelp" required>
            <div id="userHelp" class="form-text">*koje će administrator koristiti prilikom prijavljivanja.</div>
          </div>
          <label class="form-label">Lozinka:</label>
          <input class="form-control mb-3" type="password" name="lozinka" required>
          <input type="submit" class="btn btn-primary adm_btn w-100" value="Unesi administratora!" name="submit">
        </form>
        <?php if($success): ?>
          <p>Uspešno ubacivanje administratora u bazu!</p>
        <?php endif; ?>
        <?php if($errors): ?>
          <?php echo $errors; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script src="./bootstrap.bundle.min.js"></script>
</body>

</html>