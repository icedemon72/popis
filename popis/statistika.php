<?php
session_start();

if (!isset($_SESSION['superadmin'])) {
  header('Location: ./index.php');
  exit();
}

if (isset($_POST['logout'])) {
  unset($_SESSION['superadmin']);
  header('Location: ./index.php');
}

include('./db.php');

$gradovi = array(
  "nazivGrada" => array(),
  "ukupno" => array(),
  "brojMladjihOd18" => array(),
  "brojStarijihOd18" => array(),
  "brojKuca" => array(),
  "brojStanova" => array(),
  "prosecnaPovrsina" => array()
);
$opstine = array(
  "nazivOpstine" => array(),
  "ukupno" => array(),
  "brojMladjihOd18" => array(),
  "brojStarijihOd18" => array(),
  "brojKuca" => array(),
  "brojStanova" => array(),
  "prosecnaPovrsina" => array()
);

// Statistika za gradove
$sql = "SELECT DISTINCT grad FROM popisani ORDER BY grad";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  array_push($gradovi['nazivGrada'], $row['grad']);
}

for ($i = 0; $i < count($gradovi['nazivGrada']); $i++) {
  $grad = $gradovi['nazivGrada'][$i];

  // ukupno stanovnika
  $sql = "SELECT COUNT(id) AS count FROM popisani WHERE grad = '$grad'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    array_push($gradovi['ukupno'], $row['count']);
  }

  // za mladje od 18
  $sql = "SELECT COUNT(id) AS count FROM popisani WHERE starost < 18 AND grad = '$grad'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    array_push($gradovi['brojMladjihOd18'], $row['count']);
  }

  // za starije od 18
  array_push($gradovi['brojStarijihOd18'], $gradovi['ukupno'][$i] - $gradovi['brojMladjihOd18'][$i]);

  // za kuce 
  $sql = "SELECT COUNT(id) AS count FROM popisani WHERE objekat = 'Kuća' AND grad = '$grad'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    array_push($gradovi['brojKuca'], $row['count']);
  }

  // za stanove
  array_push($gradovi['brojStanova'], $gradovi['ukupno'][$i] - $gradovi['brojKuca'][$i]);

  // prosecna povrsina objekta
  $sql = "SELECT ROUND(AVG(povrsina), 2) AS povrsina FROM popisani WHERE grad = '$grad'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    array_push($gradovi['prosecnaPovrsina'], $row['povrsina']);
  }
}

// Statistika za opstine
$sql = "SELECT DISTINCT opstina FROM popisani ORDER BY opstina";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  array_push($opstine['nazivOpstine'], $row['opstina']);
}

for ($i = 0; $i < count($opstine['nazivOpstine']); $i++) {
  $opstina = $opstine['nazivOpstine'][$i];

  // ukupno stanovnika
  $sql = "SELECT COUNT(id) AS count FROM popisani WHERE opstina = '$opstina'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    array_push($opstine['ukupno'], $row['count']);
  }

  // za mladje od 18
  $sql = "SELECT COUNT(id) AS count FROM popisani WHERE starost < 18 AND opstina = '$opstina'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    array_push($opstine['brojMladjihOd18'], $row['count']);
  }

  // za starije od 18
  array_push($opstine['brojStarijihOd18'], $opstine['ukupno'][$i] - $opstine['brojMladjihOd18'][$i]);

  // za kuce 
  $sql = "SELECT COUNT(id) AS count FROM popisani WHERE objekat = 'Kuća' AND opstina = '$opstina'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    array_push($opstine['brojKuca'], $row['count']);
  }

  // za stanove
  array_push($opstine['brojStanova'], $opstine['ukupno'][$i] - $opstine['brojKuca'][$i]);

  // prosecna povrsina objekta
  $sql = "SELECT ROUND(AVG(povrsina), 2) AS povrsina FROM popisani WHERE opstina = '$opstina'";
  $result = $conn->query($sql);
  while ($row = $result->fetch_assoc()) {
    array_push($opstine['prosecnaPovrsina'], $row['povrsina']);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Statistika</title>
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
            <a class="nav-link" href="./dodavanje_admina.php">Dodaj admina</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./statistika.php">Statistika</a>
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

  <div class="container-fluid">
    <h1 class="text-center mt-2 mb-5">Statistika</h1>
    <div class="row mb-5">
      <h3 class="text-center mb-1">Gradovi</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Naziv grada</th>
            <th scope="col">Broj maloletnih</th>
            <th scope="col">Broj punoletnih</th>
            <th scope="col">U kućama</th>
            <th scope="col">U stanovima</th>
            <th scope="col">Pros. povr. objekta</th>
            <th scope="col">Ukupno stanovnika</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i = 0; $i < count($gradovi['nazivGrada']); $i++): ?>
            <tr>
              <th scope="row"><?php echo $gradovi['nazivGrada'][$i] ?></th>
              <td><?php echo $gradovi['brojMladjihOd18'][$i]?></td>
              <td><?php echo $gradovi['brojStarijihOd18'][$i]?></td>
              <td><?php echo $gradovi['brojKuca'][$i]?></td>
              <td><?php echo $gradovi['brojStanova'][$i]?></td>
              <td><?php echo $gradovi['prosecnaPovrsina'][$i]?></td>
              <td><?php echo $gradovi['ukupno'][$i]?></td>
            </tr>
          <?php endfor; ?>
        </tbody>
      </table>

    </div>
    <div class="row">
    <h3 class="text-center mb-1">Opštine</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Naziv opštine</th>
            <th scope="col">Broj maloletnih</th>
            <th scope="col">Broj punoletnih</th>
            <th scope="col">U kućama</th>
            <th scope="col">U stanovima</th>
            <th scope="col">Pros. povr. objekta</th>
            <th scope="col">Ukupno stanovnika</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i = 0; $i < count($opstine['nazivOpstine']); $i++): ?>
            <tr>
              <th scope="row"><?php echo $opstine['nazivOpstine'][$i] ?></th>
              <td><?php echo $opstine['brojMladjihOd18'][$i]?></td>
              <td><?php echo $opstine['brojStarijihOd18'][$i]?></td>
              <td><?php echo $opstine['brojKuca'][$i]?></td>
              <td><?php echo $opstine['brojStanova'][$i]?></td>
              <td><?php echo $opstine['prosecnaPovrsina'][$i]?></td>
              <td><?php echo $opstine['ukupno'][$i]?></td>
            </tr>
          <?php endfor; ?>
        </tbody>
      </table>

    </div>
  </div>

  <script src="./bootstrap.bundle.min.js"></script>
</body>

</html>