<!DOCTYPE html>
<html lang="es">

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

<body class="form__body">
  <form class="form__add" method="post">
    <div class="form__head">
      <h3 class="form__title">Agregar</h3>
      <p class="form__text">Proveedor</p>
    </div>
    <div class="form__secs">
      <div class="form__sec">
        <label class="form__label">Nombnre</label>
        <input class="form__input" type="text" name="name">
      </div>
      <div class="form__sec">
        <label class="form__label">Direccion</label>
        <input class="form__input" type="text" name="address">
      </div>
      <div class="form__sec">
        <label class="form__label">Telfono</label>
        <input class="form__input" type="text" name="phone">
      </div>
      <div class="form__sec">
        <label class="form__label">Descripcion</label>
        <textarea class="form__input form__input-textarea" name="info" rows="1"></textarea>
      </div>
    </div>
    <div class="form__btns">
      <button type="reset" id="btn-form-cancel" class="form__btn-cancel">Cancelar</button>
      <button type="submit" id="btn-form-submit" class="form__btn-submit" name="confirm">Confirmar</button>
    </div>
  </form>
  <?php
  if (isset($_POST['confirm'])) {
    AddProveedor(
      $_POST['name'],
      $_POST['address'],
      $_POST['phone'],
      $_POST['info'],
    );
  }
  function AddProveedor($name, $address, $phone, $info)
  {
    include '../../connect.php';
    mysqli_query($conn, "INSERT INTO Proveedores (name, address, phone, info) VALUES ('$name','$address','$phone','$info')");
  echo "<script>
  alert('Proveedore Registrado correctamente');
      window.top.frames['iframe_main'].location.reload();
  </script>";
  }
  ?>
  <script src="../../js/content.js"></script>
</body>

</html>
