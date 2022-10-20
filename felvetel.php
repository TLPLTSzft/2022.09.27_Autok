<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autók</title>
</head>

<body>
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
      <input type="number" name="gyartas_eve" id="gyartas_eve_input" placeholder="Gyártás éve">
    </div>

    <div>
      <label for="uzemanyag_input">Üzemanyag típus</label>
      <select name="uzemanyag" id="uzemanyag_input">
        <option value=""></option>
        <option value="benzin">Benzin</option>
        <option value="gazolaj">Gázolaj</option>
        <option value="elektromos">Elektromos</option>
        <option value="hibrid">Hibrid</option>
      </select>
    </div>

    <button type="submit">Felvétel</button>

  </form>
</body>

</html>