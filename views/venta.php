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
      <h1 class="content__title">Ventas</h1>

      <div class="content__bar">
        <a href="./venta/add.php" target="iframe_main"><button id='close_aside' class="content__add-btn"><i class="fa-solid fa-plus"></i></button></a>

        <form class="content__search" method="post">
          <select id="opt_search" name="opt_search" class="content__search-filter">
            <option value="">Todos</option>
            <option value="id">Id</option>
            <option value="date">Fecha</option>
            <option value="pago">Pago</option>
            <option value="cliente">Cliente</option>
          </select>
          <input type="text" id="txt_search" class="content__search-text" name="txt_search" placeholder="Nombre del Producto">
          <input type="submit" class="content__search-btn" name="btn_search" value="Buscar">
        </form>
        <script>
          // Esto cambia el input entre text y date para realizar busquedas por tipo
          var opt = document.getElementById("opt_search");
          var txt = document.getElementById("txt_search");
          opt.addEventListener("change", ChangeInput);

          function ChangeInput() {
            if (opt.value == "date") {
              txt.type = "date";
            } else {
              txt.type = "text";
            }
          }
        </script>

      </div>
    </div>

    <table class="content__table">
      <thead class="content__table-head">
        <tr class="">
          <th>Id</th>
          <th>Fecha</th>
          <th>Total</th>
          <th>Pago</th>
          <th>Cliente</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody class="content__table-body">
        <?php
        if (isset($_POST['btn_search'])) {
          $opt = $_POST['opt_search'];
          $txt = $_POST['txt_search'];

          if ($opt == "id" || $opt == "date") {
            $sql = mysqli_query($conn, "SELECT * FROM Ventas WHERE $opt LIKE '$txt%'");
          }
          if ($opt == "pago") {
            $pago = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM Pagos WHERE code='$txt'"));
            $sql = mysqli_query($conn, "SELECT * FROM Ventas WHERE Pagos_id='$pago[id]'");
          }
          if ($opt == "cliente") {
            $cliente = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM Usuarios WHERE icard='$txt'"));
            $sql = mysqli_query($conn, "SELECT * FROM Ventas WHERE Cliente_id='$cliente[id]'");
          }
          if ($opt == "") {
            $sql = mysqli_query($conn, "SELECT * FROM Ventas");
          }
        } else {
          $sql = mysqli_query($conn, "SELECT * FROM Ventas");
        }
        while ($data = mysqli_fetch_array($sql)) {
          echo "<tr>";
          echo "<td>" . $data['id'] . "</td>";
          echo "<td>" . $data['date'] . "</td>";
          echo "<td>" . $data['total'] . "</td>";
          // Busca en la base de datos el id de Pago relacionado con la venta y trae el codigo
          $code = mysqli_fetch_assoc(mysqli_query($conn, "SELECT code FROM Pagos WHERE id=$data[Pagos_id]"));
          echo "<td>" . $code['code'] . "</td>";
          // Busca en la base de datos el id de Cliente relacionado con la venta y trae la cedula
          $cedula = mysqli_fetch_assoc(mysqli_query($conn, "SELECT icard,name,surname FROM Usuarios WHERE id=$data[Cliente_id]"));
          echo "<td> $cedula[icard] | $cedula[name] $cedula[surname]</td>";
          echo "<td><a target='iframe_aside' href='./venta/det.php?id=$data[id]'><button id='btn_info'>Detalles</button></a></td>";
          echo "</tr>";
        }
        ?>
        <script src="../js/content.js"></script>
      </tbody>
    </table>
  </div>
</body>

</html>
