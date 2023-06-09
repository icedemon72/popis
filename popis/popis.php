<?php
session_start();

if (!isset($_SESSION['superadmin']) && !isset($_SESSION['admin'])) {
  header('Location: ./index.php');
  exit();
}

include('./db.php');

$success = false;

if(isset($_POST['submit'])) {
  $ime = $_POST['ime'];
  $datum = $_POST['datum'];
  $grad = $_POST['grad'];
  $opstina = $_POST['opstina'];
  $adresa = $_POST['adresa'];
  $objekat = $_POST['objekat'];
  $povrsina = $_POST['povrsina'];
  $clanovi = $_POST['clanovi'];
  $strucna = $_POST['strucna'];
  $posao = $_POST['posao'];
  $brak = $_POST['brak'];

  $danasnji_datum = date('Y-m-d');
  $godine = floor(abs(strtotime($danasnji_datum) - strtotime($datum)) / 31536000);
  
  $sql = "INSERT INTO popisani(ime, grad, opstina, adresa, objekat, povrsina, broj_clanova, datum_rodjenja, starost, strucna_sprema, posao, bracni_status)
          VALUES ('$ime', '$grad', '$opstina', '$adresa', '$objekat', '$povrsina', '$clanovi', '$datum', '$godine', '$strucna', '$posao', '$brak');";

  if($conn->query($sql)) {
    $success = true;
    header('Refresh: 1, URL=./popis.php');
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Popis</title>
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
          <?php if (isset($_SESSION['admin'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="./admin.php">Početna</a>
            </li>
          <?php endif; ?>
          <?php if (isset($_SESSION['superadmin'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="./superadmin.php">Početna</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./dodavanje_admina.php">Dodaj admina</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./statistika.php">Statistika</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./popis.php">Popis</a>
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
  
  <h1 class="text-center mt-2">Popis</h1>

  <div class="popis_cont container-fluid">
    <div class="row d-flex justify-content-center">
      <div class="col-lg-6 col-md-8 col-sm-12">
        <form method="post" id="popisForm">
          <label class="form-label">Ime i prezime:</label>
          <input class="form-control" type="text" name="ime">
          <label class="form-label">Datum rodjenja:</label>
          <input class="form-control" type="date" name="datum">
          <label class="form-label">Grad:</label>
          <input class="form-control" type="text" name="grad">
          <label class="form-label">Opština:</label>
          <input class="form-control" type="text" name="opstina">
          <label class="form-label">Adresa:</label>
          <input class="form-control" type="text" name="adresa">
          <label class="form-label label_select">Objekat:</label>
          <select class="form-select" name="objekat">
            <option value="Kuća">Kuća</option>
            <option value="Stan">Stan</option>
          </select>
          <label class="form-label">Površina (u m&#178;):</label>
          <input class="form-control" type="number" step="0.01" name="povrsina">
          <label class="form-label">Broj članova porodice:</label>
          <input class="form-control" type="number" name="clanovi">
          <label class="form-label">Stručna sprema:</label>
          <input class="form-control" type="text" name="strucna">
          <label class="form-label label_select">Status posla:</label>
          <select class="form-select" name="posao">
            <option value="Učenik/Student">Učenik/Student</option>
            <option value="Nezaposlen">Nezaposlen</option>
            <option value="Zaposlen">Zaposlen</option>
          </select>
          <label class="form-label label_select_last">Bračni status:</label>
          <select class="form-select" name="brak">
            <option value="Nije u bračnom odnosu">Nije u bračnom odnosu</option>
            <option value="U bračnom je odnosu">U bračnom je odnosu</option>
            <option value="Razveden/a">Razveden/a</option>
          </select>
          <input type="submit" class="btn btn-primary sbm_btn w-100" value="Unesi gradjanina!" name="submit">
        </form>
        <?php if($success): ?>
          <p>Uspešno unešen gradjanin <?php echo $_POST['ime']; ?>!</p>
        <?php endif; ?>
      </div>
    </div>   
  </div>


  <script src="./bootstrap.bundle.min.js"></script>
</body>

</html>