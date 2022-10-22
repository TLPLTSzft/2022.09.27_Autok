<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Autók</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Rendszám</th>
        <th>Márka</th>
        <th>Modell</th>
        <th>Gyártás éve</th>
        <th>Üzemanyag típus</th>
      </tr>
    </thead>

    <tbody>
      <?php
      $file = fopen("autok.csv", "r");

      $uzemanyag_tipusok = [
        'benzin' => "Benzin",
        'gazolaj' => "Gázolaj",
        'elektromos' => "Elektromos",
        'hibrid' => "Hibrid"
      ];

      $i = 0;
      while ($sor = fgets($file)) :
        $i++;
        $adatok = explode(';', trim($sor));
      ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $adatok[0] ?></td>
          <td><?php echo $adatok[1] ?></td>
          <td><?php echo $adatok[2] ?></td>
          <td><?php echo $adatok[3] ?></td>
          <td><?php echo $uzemanyag_tipusok[$adatok[4]] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>

    <tfoot>
      <tr>
        <th>#</th>
        <th>Rendszám</th>
        <th>Márka</th>
        <th>Modell</th>
        <th>Gyártás éve</th>
        <th>Üzemanyag típus</th>
      </tr>
    </tfoot>

  </table>

</body>

</html>