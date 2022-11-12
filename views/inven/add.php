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
  <div class="form__head">
    <h3 class="form__title">Agregar</h3>
    <div class="form__btns">
      <button class="form__btn-1" id="btn-form-pro">Producto</button>
      <button class="form__btn-2 disable" id="btn-form-cat">Categoria</button>
    </div>
  </div>
  <form id="form-pro" class="form__add" method="post">
    <div class="form__secs">
      <div class="form__sec">
        <label class="form__label">Nombnre</label>
        <input class="form__input" type="text" name="name">
      </div>
      <div class="form__sec">
        <label class="form__label">Cantidad</label>
        <input class="form__input" type="number" name="stock">
      </div>
      <div class="form__sec">
        <label class="form__label">Precio</label>
        <input class="form__input" type="number" name="price">
      </div>
      <div class="form__sec">
        <label class="form__label">Descripcion</label>
        <textarea class="form__input form__input-textarea" name="info" rows="1"></textarea>
      </div>
      <div class="form__sec">
        <label class="form__label">Categoria</label>
        <select class="form__input" type="number" name="cat_id">
          <?php
          include_once '../../connect.php';
          $sql = mysqli_query($conn, "SELECT id, name FROM Categorias");
          while ($data = mysqli_fetch_array($sql)) {
            echo "<option value='$data[id]'>$data[id] | $data[name]</option>";
          }
          ?>
        </select>
      </div>
      <div class="form__sec">
        <label class="form__label">Proveedor</label>
        <select class="form__input" type="number" name="pro_id">
          <?php
          include_once '../../connect.php';
          $sql = mysqli_query($conn, "SELECT id, name FROM Proveedores");
          while ($data = mysqli_fetch_array($sql)) {
            echo "<option value='$data[id]'>$data[id] | $data[name]</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form__btns">
      <button type="reset" id="btn-form-cancel" class="form__btn-cancel">Cancelar</button>
      <button type="submit" id="btn-form-submit" class="form__btn-submit" name="confirm">Confirmar</button>
    </div>
  </form>
  <form id="form-cat" class="form__add disable" method="post">
    <div class="form__secs">
      <div class="form__sec">
        <label class="form__label">Nombnre</label>
        <input class="form__input" type="text" name="name">
      </div>
      <div class="form__sec">
        <label class="form__label">Descripcion</label>
        <textarea class="form__input form__input-textarea" name="info" rows="1"></textarea>
      </div>
    </div>
    <div class="form__btns">
      <button type="reset" id="btn-form-cancel" class="form__btn-cancel">Cancelar</button>
      <button type="submit" id="btn-form-submit" class="form__btn-submit" name="confirmar_cat">Confirmar</button>
    </div>
  </form>
  <?php
  if (isset($_POST['confirmar_cat'])) {
    include_once '../../connect.php';
    mysqli_query($conn, "INSERT INTO Categorias (name, info) VALUES ('$_POST[name]', '$_POST[info]')");
    echo "<script>alert('Categoria Registrado correctamente')</script>";
  }
  if (isset($_POST['confirm'])) {
    AddProveedor(
      $_POST['name'],
      $_POST['stock'],
      $_POST['price'],
      $_POST['info'],
      $_POST['cat_id'],
      $_POST['pro_id'],
    );
  }
  function AddProveedor($name, $stock, $price, $info, $cat_id, $pro_id)
  {
    include '../../connect.php';
    mysqli_query($conn, "INSERT INTO Productos (name, stock, price, info, Categorias_id, Proveedores_id) VALUES ('$name','$stock','$price','$info','$cat_id','$pro_id')");
    echo "<script>
      alert('Producto Registrado correctamente');
      window.top.frames['iframe_main'].location.reload();
    </script>";
  }
  ?>

  <script>
    var pro = document.getElementById('btn-form-pro');
    var cat = document.getElementById('btn-form-cat');
    var form_pro = document.getElementById('form-pro');
    var form_cat = document.getElementById('form-cat');

    pro.addEventListener("click", OpenPro);
    cat.addEventListener("click", OpenCat);

    function OpenPro() {
      cat.classList.add("disable");
      form_cat.classList.add("disable");
      pro.classList.remove("disable");
      form_pro.classList.remove("disable");
    }

    function OpenCat() {
      pro.classList.add("disable");
      form_pro.classList.add("disable");
      cat.classList.remove("disable");
      form_cat.classList.remove("disable");
    }
  </script>
  <script src="../../js/content.js"></script>

</body>

</html>
