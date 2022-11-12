<?php
include_once '../../connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta Informacion -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sinmbas</title>
  <!-- Css -->
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/content.css">
  <!-- Link awesomefont icons -->
  <script src="https://kit.fontawesome.com/307e9e536a.js" crossorigin="anonymous"></script>
</head>

<body>
  <form class="ventas" method="post">
    <div class="ventas__header">
      <label for="">Cliente</label>
      <select name="cliente">
        <option value="">--Seleccione el Cliente--</option>
        <?php
        $sql = mysqli_query($conn, "SELECT id,icard,name,surname FROM Usuarios WHERE type=3");
        while ($cliente = mysqli_fetch_assoc($sql)) {
          echo "<option value='$cliente[id]'>$cliente[icard] | $cliente[name] $cliente[surname]</option>";
        }
        ?>
      </select>
      <a href="../users/add.php" target="iframe_aside">¿Nuevo?</a>
    </div>
    <div class="ventas__body">

    </div>
  </form>
</body>

</html>
