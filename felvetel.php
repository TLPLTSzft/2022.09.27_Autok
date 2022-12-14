<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autók</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function validalas() {
      const rendszam = document.forms['auto_felvetel']['rendszam'].value;
      const marka = document.forms['auto_felvetel']['marka'].value;
      const modell = document.forms['auto_felvetel']['modell'].value;
      const gyartas_eve = document.forms['auto_felvetel']['gyartas_eve'].value;
      const uzemanyag = document.forms['auto_felvetel']['uzemanyag'].value;
      if (rendszam.trim().length == 0) {
        alert("Rendszám megadása kötelező");
        return false;
      }
      if (marka.trim().length == 0) {
        alert("Márka megadása kötelező");
        return false;
      }
      if (modell.trim().length == 0) {
        alert("Modell megadása kötelező");
        return false;
      }
      if (gyartas_eve.trim().length == 0) {
        alert("Gyártás éve megadása kötelező");
        return false;
      }
      if (gyartas_eve != parseInt(gyartas_eve)) {
        alert("Gyártás éve csak szám lehet");
        return false;
      }
      const maiDatum = new Date().getFullYear();
      if (gyartas_eve < 1900 || gyartas_eve > maiDatum) {
        alert("Gyártás éve 1900 és " + maiDatum + " közé kell hogy essen");
        return false;
      }
      if (uzemanyag.trim().length == 0) {
        alert("Üzemanyag típus megadása kötelező");
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Autók</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Autók listázása</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="felvetel.php">Autó felvétele</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container">

    <!-- <pre><?php print_r($_POST); ?></pre> -->
    <?php
    $uzemanyag_tipusok = [
      'benzin' => "Benzin",
      'gazolaj' => "Gázolaj",
      'elektromos' => "Elektromos",
      'hibrid' => "Hibrid"
    ];
    ?>
    <?php
    if (isset($_POST) && !empty($_POST)) {
      $hiba = "";
      if (!isset($_POST['rendszam']) || empty($_POST['rendszam'])) {
        $hiba .= "Rendszám mező kitöltése kötelező. ";
      }
      if (!isset($_POST['marka']) || empty($_POST['marka'])) {
        $hiba .= "Márka mező kitöltése kötelező. ";
      }
      if (!isset($_POST['modell']) || empty($_POST['modell'])) {
        $hiba .= "Modell mező kitöltése kötelező. ";
      }
      if (!isset($_POST['gyartas_eve']) || empty($_POST['gyartas_eve'])) {
        $hiba .= "Gyártás éve mező kitöltése kötelező. ";
      } else if (!is_numeric($_POST['gyartas_eve']) || round($_POST['gyartas_eve']) != $_POST['gyartas_eve']) {
        $hiba .= "Gyártás éve csak egész szám lehet. ";
      } else if ($_POST['gyartas_eve'] < 1900 || $_POST['gyartas_eve'] > date("Y")) {
        $hiba .= "Gyártás éve 1900 és " . date("Y") . " közé kell hogy essen. ";
      }
      if (!isset($_POST['uzemanyag']) || empty($_POST['uzemanyag'])) {
        $hiba .= "Üzemanyag típus mező kitöltése kötelező. ";
      } else if (!in_array($_POST['uzemanyag'], array_keys($uzemanyag_tipusok))) {
        $hiba .= "Üzemanyag típust a legördülő menüből válassza ki. ";
      }
    ?>
      <?php if ($hiba == "") : ?>
        <?php
        $file = fopen("autok.csv", "a");
        $sor = implode((";"), $_POST) . PHP_EOL;
        fwrite($file, $sor);
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Sikeres felvétel.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php else : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $hiba; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
    <?php
    }
    ?>
    <h1>Autók felvétele</h1>
    <form action="felvetel.php" method="post" name="auto_felvetel" onsubmit="return validalas()">
      <div class="mb-3">
        <label for="rendszam_input">Rendszám</label>
        <input class="form-control" type="text" name="rendszam" id="rendszam_input" placeholder="Rendszám" required>
      </div>
      <div class="mb-3">
        <label for="marka_input">Márka</label>
        <input class="form-control" type="text" name="marka" id="marka_input" placeholder="Márka" required>
      </div>
      <div class="mb-3">
        <label for="modell_input">Modell</label>
        <input class="form-control" type="text" name="modell" id="modell_input" placeholder="Modell" required>
      </div>
      <div class="mb-3">
        <label for="gyartas_eve_input">Gyártás éve</label>
        <!-- <input class="form-control" type="text" name="gyartas_eve" id="gyartas_eve_input" placeholder="Gyártás éve"> -->
        <input class="form-control" type="number" name="gyartas_eve" id="gyartas_eve_input" placeholder="Gyártás éve" required>
      </div>
      <div class="mb-3">
        <label for="uzemanyag_input">Üzemanyag típus</label>
        <select class="form-select" name="uzemanyag" id="uzemanyag_input" required>
          <option value=""></option>
          <?php foreach ($uzemanyag_tipusok as $key => $value) : ?>
            <option value="<?php echo $key ?>"><?php echo $value ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <button class="btn btn-outline-secondary" type="submit">Felvétel</button>
    </form>
  </main>
</body>

</html>