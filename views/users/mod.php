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
  <?php
  include '../../connect.php';
  $id = $_GET['id'];
  $sql = mysqli_query($conn, "SELECT * FROM Usuarios WHERE id=$id");
  $data = mysqli_fetch_array($sql);
  ?>
  <form class="form__mod" method="post">
    <div class="form__head">
      <h3 class="form__title">Modificar</h3>
      <p class="form__text">Usuario</p>
    </div>
    <div class="form__secs">
      <input class="form__input" type="text" name="id" value="<?= $data['id'] ?>" hidden>

      <div class="form__sec">
        <label class="form__label">Tipo</label>
        <select class="form__input" name="type">
          <?php
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
          }
          ?>
          <option value="<?= $data['type'] ?>"><?= $type ?></option>
          <option value="1">Admin</option>
          <option value="2">Emplado</option>
          <option value="3">Cliente</option>
        </select>
      </div>
      <div class="form__sec">
        <label class="form__label">Cedula</label>
        <input class="form__input" type="number" name="icard" value="<?= $data['icard'] ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Nombnre</label>
        <input class="form__input" type="text" name="name" value="<?= $data['name'] ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Apelldo</label>
        <input class="form__input" type="text" name="surname" value="<?= $data['surname'] ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Dirreccion</label>
        <input class="form__input" type="text" name="address" value="<?= $data['address'] ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Telefono</label>
        <input class="form__input" type="number" name="phone" value="<?= $data['phone'] ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Email</label>
        <input class="form__input" type="email" name="email" value="<?= $data['email'] ?>">
      </div>
    </div>
    <div class="form__btns">
      <button type="reset" id="btn-form-cancel" class="form__btn-cancel">Cancelar</button>
      <button type="submit" id="btn-form-submit" class="form__btn-submit" name="confirm">Confirmar</button>
    </div>

  </form>
  <?php
  if (isset($_POST['confirm'])) {
    ModUsuario(
      $_POST['id'],
      $_POST['type'],
      $_POST['icard'],
      $_POST['name'],
      $_POST['surname'],
      $_POST['address'],
      $_POST['phone'],
      $_POST['email'],
    );
  }
  function ModUsuario($id, $type, $icard, $name, $surname, $address, $phone, $email)
  {
    include '../../connect.php';
    mysqli_query($conn, "UPDATE Usuarios SET type='$type', icard='$icard', name='$name', surname='$surname', address='$address', phone='$phone', email='$email' WHERE id='$id'");
    echo "<script>
      alert('Usuario Actualizado Correctamente')
      window.top.frames['iframe_main'].location.reload();
    </script>";
  }
  ?>
  <script src="../../js/content.js"></script>
</body>

</html>
