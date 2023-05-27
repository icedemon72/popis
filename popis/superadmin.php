<?php
session_start();

if (!isset($_SESSION['superadmin'])) {
  header('Location: ./index.php');
  exit();
}

include('./db.php');

$sql = "SELECT COUNT(id) AS count FROM popisani";

$brojPopisanih = 0;

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
  $brojPopisanih = $row['count'];
}

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
          <?php if (isset($_SESSION['superadmin'])) : ?>
            <li class="nav-item">
              <a class="nav-link active" href="./dodavanje_admina.php">Početna</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./dodavanje_admina.php">Dodaj admina</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./statistika.php">Statistika</a>
            </li>
          <?php endif; ?>
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

  <h2 class="text-center mt-4">Dobrodošao, superadmine!</h2>

  <p class="text-center">Do sada, popisano je <b><?php echo $brojPopisanih; ?></b> gradjana!</p>

  <div class="container-fluid mt-5">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
        <div class="card" style="width: 60%;">
          <img class="card-img-top" src="./img/admin.png" alt="Admin">
          <div class="card-body">
            <h5 class="text-center card-title">Dodaj administratora</h5>
            <p class="card-text">Dodaj administratora koji će vršiti popis.</p>
            <div class="row d-flex-justify-content-center">
              <a href="./dodavanje_admina.php" class="btn btn-primary">Na dodavanje!</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
        <div class="card" style="width: 60%;">
          <img class="card-img-top" src="./img/stat.png" alt="Statistika">
          <div class="card-body">
            <h5 class="text-center card-title">Statistika</h5>
            <p class="card-text">Vidi informacije i statistiku popisanih u bazi.</p>
            <div class="row d-flex-justify-content-center">
              <a href="./statistika.php" class="btn btn-primary">Na statistiku!</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center">
        <div class="card" style="width: 60%;">
          <img class="card-img-top" src="./img/pen.png" alt="Olovka">
          <div class="card-body">
            <h5 class="text-center card-title">Popis</h5>
            <p class="card-text">Superadmin, takodje, može raditi popis.</p>
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