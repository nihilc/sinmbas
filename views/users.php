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
      <h1 class="content__title">Usuarios</h1>

      <div class="content__bar">
        <a href="./users/add.php" target="iframe_aside"><button id="btn_new" class="content__add-btn"><i class="fa-solid fa-plus"></i></button></a>

        <form class="content__search" method="post">
          <select name="opt_search" class="content__search-filter">
            <option value="">Todos</option>
            <option value="id">Id</option>
            <option value="type">Tipo</option>
            <option value="icard">Cedula</option>
            <option value="name">Nombre</option>
            <option value="surname">Apellido</option>
            <option value="phone">Telefono</option>
            <option value="email">Email</option>
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
          <th>Tipo</th>
          <th>Cedula</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Dirreccion</th>
          <th>Telefono</th>
          <th>Email</th>
          <th colspan="2">Opciones</th>
        </tr>
      </thead>
      <tbody class="content__table-body">
        <?php
        if (isset($_POST['btn_search']) && strlen($_POST['txt_search']) >= 1) {
          $opt = $_POST['opt_search'];
          $txt = $_POST['txt_search'];
          if ($opt == "type") {
            if($txt == "Admin"){$txt = 1;}
            if($txt == "Empleado"){$txt = 2;}
            if($txt == "Cliente"){$txt = 3;}
          }
          $sql = mysqli_query($conn, "SELECT * FROM Usuarios WHERE $opt LIKE '$txt'");
        } else {
          $sql = mysqli_query($conn, "SELECT * FROM Usuarios");
        }
        while ($data = mysqli_fetch_array($sql)) {
          echo "<tr>";
          echo "<td>" . $data['id'] . "</td>";
          switch ($data['type']) {
            case 1:
              $type = "Admin";
              break;
            case 2:
              $type = "Empleado";
              break;
            case 3:
              $type = "Cliente";
              break;
            default:
              $type = "Desnocido";
          }
          echo "<td>" . $type . "</td>";
          echo "<td>" . $data['icard'] . "</td>";
          echo "<td>" . $data['name'] . "</td>";
          echo "<td>" . $data['surname'] . "</td>";
          echo "<td>" . $data['address'] . "</td>";
          echo "<td>" . $data['phone'] . "</td>";
          echo "<td>" . $data['email'] . "</td>";
          echo "<td><a target='iframe_aside' href='./users/mod.php?id=$data[id]'><button id='btn_mod'>Modificar</button></a></td>";
          echo "<td><a target='iframe_aside' href='./users/del.php?id=$data[id]'><button id='btn_del' onClick=\"Javascrip: return confirm('¿Desea iminar a este Usuario?');\">Eliminar</button></a></td>";
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
