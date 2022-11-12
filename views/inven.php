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
      <h1 class="content__title">Inventarios</h1>

      <div class="content__bar">
        <a href="./inven/add.php" target="iframe_aside"><button id="btn_new" class="content__add-btn"><i class="fa-solid fa-plus"></i></button></a>

        <form class="content__search" method="post">
          <select name="opt_search" class="content__search-filter">
            <option value="">Categoria</option>
            <?php
            $sqlcat = mysqli_query($conn, "SELECT name,id FROM Categorias");
            while ($cat = mysqli_fetch_assoc($sqlcat)) {
              echo "<option value='$cat[id]'>$cat[name]</option>";
            }
            ?>
          </select>
          <input type="text" class="content__search-text" name="txt_search" placeholder="Nombre del Producto">
          <input type="submit" class="content__search-btn" name="btn_search" value="Buscar">
        </form>

      </div>
    </div>

    <table class="content__table">
      <thead class="content__table-head">
        <tr class="">
          <th>Id</th>
          <th>Nombre</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Descripcion</th>
          <th>Categoria</th>
          <th>Proveedor</th>
          <th colspan="2">Opciones</th>
        </tr>
      </thead>
      <tbody class="content__table-body">
        <?php
        if (isset($_POST['btn_search'])) {

          $opt = $_POST['opt_search'];
          $txt = $_POST['txt_search'];

          // TODO: Agregar filtro de proveedores
          if ($opt == "") {
            $sql = mysqli_query($conn, "SELECT * FROM Productos WHERE name LIKE '%$txt%'");
          } else {
            $sql = mysqli_query($conn, "SELECT * FROM Productos WHERE Categorias_id LIKE '$opt' AND name LIKE '%$txt%'");
          }
        } else {
          $sql = mysqli_query($conn, "SELECT * FROM Productos");
        }

        while ($data = mysqli_fetch_array($sql)) {
          echo "<tr>";
          echo "<td>" . $data['id'] . "</td>";
          echo "<td>" . $data['name'] . "</td>";
          echo "<td>" . $data['stock'] . "</td>";
          echo "<td>" . $data['price'] . "</td>";
          echo "<td>" . $data['info'] . "</td>";
          // Busca en la base de datos el id de categoria relacionado con el producto y trae el nombre
          $catname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM Categorias WHERE id=$data[Categorias_id]"));
          echo "<td>" . $catname['name'] . "</td>";
          // Busca en la base de datos el id de proveedor relacionado con el producto y trae el nombre
          $proname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name FROM Proveedores WHERE id=$data[Proveedores_id]"));
          echo "<td>" . $proname['name'] . "</td>";
          echo "<td><a target='iframe_aside' href='./inven/mod.php?id=$data[id]'><button id='btn_mod'>Modificar</button></a></td>";
          echo "<td><a target='iframe_aside' href='./inven/del.php?id=$data[id]'><button id='btn_del' onClick=\"Javascrip: return confirm('¿Desea iminar a este Producto?');\">Eliminar</button></a></td>";
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
