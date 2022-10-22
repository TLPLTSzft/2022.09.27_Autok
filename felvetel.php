<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autók</title>
</head>

<body>

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
      <p>Sikeres felvétel</p>
    <?php else : ?>
      <p><?php echo $hiba; ?></p>
    <?php endif; ?>
  <?php
  }
  ?>

  <h1>Autók felvétele</h1>
  <form action="felvetel.php" method="post" name="auto_felvetel">

    <div>
      <label for="rendszam_input">Rendszám</label>
      <input type="text" name="rendszam" id="rendszam_input" placeholder="Rendszám">
    </div>

    <div>
      <label for="marka_input">Márka</label>
      <input type="text" name="marka" id="marka_input" placeholder="Márka">
    </div>

    <div>
      <label for="modell_input">Modell</label>
      <input type="text" name="modell" id="modell_input" placeholder="Modell">
    </div>

    <div>
      <label for="gyartas_eve_input">Gyártás éve</label>
      <!-- <input type="text" name="gyartas_eve" id="gyartas_eve_input" placeholder="Gyártás éve"> -->
      <input type="number" name="gyartas_eve" id="gyartas_eve_input" placeholder="Gyártás éve">
    </div>

    <div>
      <label for="uzemanyag_input">Üzemanyag típus</label>
      <select name="uzemanyag" id="uzemanyag_input">
        <option value=""></option>
        <?php foreach ($uzemanyag_tipusok as $key => $value) : ?>
          <option value="<?php echo $key ?>"><?php echo $value ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <button type="submit">Felvétel</button>

  </form>
</body>

</html>