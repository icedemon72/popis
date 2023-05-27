<?php
// pokrecemo sesiju
session_start();

// proveravamo da li je korisnik administrator
if (!isset($_SESSION['admin'])) {
  header('Location: ./index.php');
  exit();
}

// ukljucujemo vezu sa bazom
include('./db.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Superadmin Meni</title>
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
            <a class="nav-link active" aria-current="page" href="./admin.php">Početna</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./popis.php">Popis</a>
          </li>
        </ul>
        <div class="nav-item d-flex">
          <form method="post" action="./logout.php">
            <input class="nav-link" type="submit" value="Izloguj se" name="logout">
          </form>
        </div>
      </div>
    </div>
  </nav>
  <!-- OVDE PREKO SESIJE UZIMAMO IME ULOGOVANOG ADMINA  -->
  <h2 class="text-center mt-4">Dobrodošao, <?php echo $_SESSION['admin']; ?>!</h2> 

  <p class="text-center">Spreman za popisivanje?</p>

  <div class="container-fluid mt-5">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
        <div class="card" style="width: 60%;">
          <img class="card-img-top" src="./img/pen.png" alt="Olovka">
          <div class="card-body">
            <div class="row d-flex-justify-content-center">
              <a href="./popis.php" class="btn btn-primary">Na popis!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./bootstrap.bundle.min.js"></script>
</body>

</html>