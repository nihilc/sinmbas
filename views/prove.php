<?php
include "../connect.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Meta Informacion -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sinmbas</title>
  <!-- Css -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/content.css">
  <!-- Link awesomefont icons -->
  <script src="https://kit.fontawesome.com/307e9e536a.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="content">

    <div class="content__header">
      <h1 class="content__title">Proveedores</h1>

      <div class="content__bar">
        <a href="./prove/add.php" target="iframe_aside"><button id="btn_new" class="content__add-btn"><i class="fa-solid fa-plus"></i></button></a>

        <form class="content__search" method="post">
          <select name="opt_search" class="content__search-filter">
            <option value="">Todos</option>
            <option value="id">Id</option>
            <option value="name">Nombre</option>
            <option value="phone">Telefono</option>
          </select>
          <input type="text" class="content__search-text" name="txt_search">
          <input type="submit" class="content__search-btn" name="btn_search" value="Buscar">
        </form>

      </div>
    </div>

    <table class="content__table">
      <thead class="content__table-head">
        <tr class="">
          <th>Id</th>
          <th>Nombre</th>
          <th>Dirreccion</th>
          <th>Telefono</th>
          <th>Descripcion</th>
          <th colspan="2">Opciones</th>
        </tr>
      </thead>
      <tbody class="content__table-body">
        <?php
        if (isset($_POST['btn_search']) && strlen($_POST['btn_search']) > 1) {
          $opt = $_POST['opt_search'];
          $txt = $_POST['txt_search'];
          if ($opt == "") {
            $sql = mysqli_query($conn, "SELECT * FROM Proveedores");
          } else {
            $sql = mysqli_query($conn, "SELECT * FROM Proveedores WHERE $opt LIKE '$txt'");
          }
        } else {
          $sql = mysqli_query($conn, "SELECT * FROM Proveedores");
        }
        while ($data = mysqli_fetch_array($sql)) {
          echo "<tr>";
          echo "<td>" . $data['id'] . "</td>";
          echo "<td>" . $data['name'] . "</td>";
          echo "<td>" . $data['address'] . "</td>";
          echo "<td>" . $data['phone'] . "</td>";
          echo "<td>" . $data['info'] . "</td>";
          echo "<td><a target='iframe_aside' href='./prove/mod.php?id=$data[id]'><button id='btn_mod'>Modificar</button></a></td>";
          echo "<td><a target='iframe_aside' href='./prove/del.php?id=$data[id]'><button id='btn_del' onClick=\"Javascrip: return confirm('¿Desea iminar a este Proveedor?');\">Eliminar</button></a></td>";
          echo "</tr>";
        }
        ?>
        <script src="../js/content.js">
        </script>
      </tbody>
    </table>
  </div>
</body>

</html>
