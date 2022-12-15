<?php
function VerifiForm($type, $icard, $name, $surname, $address, $phone, $email): bool
{
  // Comprobando que los campos no esten vacios
  if (empty($type) || empty($icard) || empty($name) || empty($surname) || empty($address) || empty($phone) || empty($email)) {
    throw new Exception("Campos incompletos llene todos con el *");
  }
  // Comprobando tipo de usuario
  if ($type != 1 && $type != 2 && $type != 3) {
    throw new Exception("Tipo de usuario incorrecto");
  }
  // Comprobando Cedula
  if (!ctype_digit($icard)) {
    throw new Exception("Ingrese solo numeros en la cedula");
  }
  if (strlen($icard) > 10) {
    throw new Exception("Cedula muy larga (max. 10)");
  }
  if (strlen($icard) < 9) {
    throw new Exception("Cedula muy corta (min. 9)");
  }
  // Comprobando Nombres
  if (!ctype_alpha($name) || !ctype_alpha($surname)) {
    throw new Exception("Los nombres solo deben tener letras");
  }
  // Comprobando Telefono
  if (!ctype_digit($phone)) {
    throw new Exception("Numero de telefono solo recibe numeros (1-9)");
  }
  if (strlen($phone) < 10) {
    throw new Exception("Numero de telefono muy corto (min. 10). En caso de fijo agregar (601)");
  }
  // Comprobando email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    throw new Exception("Formato de correo electronico incorrecto Ej.(nombre@email.com)");
  }
  // Si pasa todas las comprobaciones devuelve true
  return true;
}
function ModUsuario($id, $type, $icard, $name, $surname, $address, $phone, $email)
{
  include '../../connect.php';
  mysqli_query($conn, "UPDATE Usuarios SET type='$type', icard='$icard', name='$name', surname='$surname', address='$address', phone='$phone', email='$email' WHERE id='$id'");
  echo "<script>
  alert('Usuario Actualizado Correctamente');
  window.top.frames['iframe_main'].location.reload();
  </script>";
}

if (isset($_POST['confirm'])) {
  // Salva informacion del formulario para no llenarlo desde 0 cada vez
  $f_type = $_POST['type'];
  $f_icard = $_POST['icard'];
  $f_name = $_POST['name'];
  $f_surname = $_POST['surname'];
  $f_address = $_POST['address'];
  $f_phone = $_POST['phone'];
  $f_email = $_POST['email'];
  try {
    // Verifica los datos que sean en el formato correcto y los intenta ingresar en la db
    $form_ok = VerifiForm($f_type, $f_icard, $f_name, $f_surname, $f_address, $f_phone, $f_email,);
    if ($form_ok == true) ModUsuario($_POST['id'], $f_type, $f_icard, $f_name, $f_surname, $f_address, $f_phone, $f_email,);
  } catch (Exception $e) {
    // en caso de error guarda la informacion del mismo para mostrarlo al usuario
    $f_error = "<div class='form__error'>Error: " . $e->getMessage() . "</div>";
  }
}

include '../../connect.php';
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM Usuarios WHERE id=$_GET[id]"));
?>
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
          if (isset($f_type)) {
            if ($f_type == 1) echo "<option value='1'>Admin</option>";
            if ($f_type == 2) echo "<option value='2'>Empleado</option>";
            if ($f_type == 3) echo "<option value='3'>Cliente</option>";
          } else {
            if ($data['type'] == 1) echo "<option value='1'>Admin</option>";
            if ($data['type'] == 2) echo "<option value='2'>Empleado</option>";
            if ($data['type'] == 3) echo "<option value='3'>Cliente</option>";
          }
          ?>
          <option value="1">Admin</option>
          <option value="2">Empleado</option>
          <option value="3">Cliente</option>
        </select>
      </div>
      <div class="form__sec">
        <label class="form__label">Cedula*</label>
        <input class="form__input" type="number" name="icard" value="<?php if (isset($f_icard)) { echo $f_icard; } else { echo $data['icard']; } ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Nombre*</label>
        <input class="form__input" type="text" name="name" value="<?php if (isset($f_name)) { echo $f_name; } else { echo $data['name']; } ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Apellido*</label>
        <input class="form__input" type="text" name="surname" value="<?php if (isset($f_surname)) { echo $f_surname; } else { echo $data['surname']; } ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Direccion*</label>
        <input class="form__input" type="text" name="address" value="<?php if (isset($f_address)) { echo $f_address; } else { echo $data['address']; }?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Telefono*</label>
        <input class="form__input" type="number" name="phone" value="<?php if (isset($f_phone)) { echo $f_phone; } else { echo $data['phone']; } ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Email*</label>
        <input class="form__input" type="email" name="email" value="<?php if (isset($f_email)) { echo $f_email; } else { echo $data['email']; } ?>">
      </div>
    </div>
    <?php if (isset($f_error)) echo $f_error ?>
    <div class="form__btns">
      <button type="reset" id="btn-form-cancel" class="form__btn-cancel">Cancelar</button>
      <button type="submit" id="" class="form__btn-submit" name="confirm">Confirmar</button>
    </div>
  </form>
  <script src="../../js/content.js"></script>
</body>

</html>
