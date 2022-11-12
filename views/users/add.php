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
      <p class="form__text">Usuario</p>
    </div>
    <div class="form__secs">
      <div class="form__sec">
        <label class="form__label">Tipo</label>
        <select class="form__input" name="type">
          <option value="1">Admin</option>
          <option value="2">Empleado</option>
          <option value="3">Cliente</option>
        </select>
      </div>
      <div class="form__sec">
        <label class="form__label">Cedula</label>
        <input class="form__input" type="number" name="icard">
      </div>
      <div class="form__sec">
        <label class="form__label">Nombnre</label>
        <input class="form__input" type="text" name="name">
      </div>
      <div class="form__sec">
        <label class="form__label">Apellido</label>
        <input class="form__input" type="text" name="surname">
      </div>
      <div class="form__sec">
        <label class="form__label">Direccion</label>
        <input class="form__input" type="text" name="address">
      </div>
      <div class="form__sec">
        <label class="form__label">Telfono</label>
        <input class="form__input" type="number" name="phone">
      </div>
      <div class="form__sec">
        <label class="form__label">Email</label>
        <input class="form__input" type="email" name="email">
      </div>
    </div>
    <div class="form__btns">
      <button type="reset" id="btn-form-cancel" class="form__btn-cancel">Cancelar</button>
      <button type="submit" id="btn-form-submit" class="form__btn-submit" name="confirm">Confirmar</button>
    </div>
  </form>
  <?php
  if (isset($_POST['confirm'])) {
    AddUsuario(
      $_POST['type'],
      $_POST['icard'],
      $_POST['name'],
      $_POST['surname'],
      $_POST['address'],
      $_POST['phone'],
      $_POST['email'],
    );
  }
  function AddUsuario($type, $icard, $name, $surname, $address, $phone, $email)
  {
    include '../../connect.php';
    mysqli_query($conn, "INSERT INTO Usuarios (type, icard, name, surname, address, phone, email) VALUES ('$type', '$icard', '$name', '$surname', '$address', '$phone', '$email')");
    echo "<script>
      alert('Usuario Registrado correctamente')
      window.top.frames['iframe_main'].location.reload();
    </script>";
  }
  ?>
  <script src="../../js/content.js"></script>
</body>

</html>
