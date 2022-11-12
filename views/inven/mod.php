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
  $sql = mysqli_query($conn, "SELECT * FROM Productos WHERE id=$id");
  $data = mysqli_fetch_array($sql);
  ?>
  <form class="form__mod" method="post">
    <div class="form__head">
      <h3 class="form__title">Modificar</h3>
      <p class="form__text">Proveedor</p>
    </div>
    <div class="form__secs">
      <div class="form__sec">
        <label class="form__label">Nombnre</label>
        <input class="form__input" type="text" name="id" value="<?= $data['id'] ?>" hidden>
        <input class="form__input" type="text" name="name" value="<?= $data['name'] ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Cantidad</label>
        <input class="form__input" type="number" name="stock" value="<?= $data['stock'] ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Precio</label>
        <input class="form__input" type="number" name="price" value="<?= $data['price'] ?>">
      </div>
      <div class="form__sec">
        <label class="form__label">Descripcion</label>
        <textarea class="form__input form__input-textarea" name="info" rows="1"><?= $data['info'] ?></textarea>
      </div>
      <div class="form__sec">
        <label class="form__label">Categoria</label>
        <select class="form__input" type="number" name="cat_id">
          <?php
          include_once '../../connect.php';

          $cat = mysqli_fetch_array(mysqli_query($conn, "SELECT id,name FROM Categorias WHERE id ='$data[Categorias_id]'"));
          echo "<option value='$cat[id]'>$cat[id] | $cat[name]</option>";

          $sql = mysqli_query($conn, "SELECT * FROM Categorias");
          while ($datacat = mysqli_fetch_array($sql)) {
            echo "<option value='$datacat[id]'>$datacat[id] | $datacat[name]</option>";
          }
          ?>
        </select>
      </div>
      <div class="form__sec">
        <label class="form__label">Proveedor</label>
        <select class="form__input" type="number" name="pro_id">
          <?php
          include_once '../../connect.php';

          $pro = mysqli_fetch_array(mysqli_query($conn, "SELECT id,name FROM Proveedores WHERE id ='$data[Proveedores_id]'"));
          echo "<option value='$pro[id]'>$pro[id] | $pro[name]</option>";

          $sql = mysqli_query($conn, "SELECT * FROM Proveedores");
          while ($datapro = mysqli_fetch_array($sql)) {
            echo "<option value='$datapro[id]'>$datapro[id] | $datapro[name]</option>";
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
  <?php
  if (isset($_POST['confirm'])) {
    ModProveedor(
      $_POST['id'],
      $_POST['name'],
      $_POST['stock'],
      $_POST['price'],
      $_POST['info'],
      $_POST['cat_id'],
      $_POST['pro_id'],
    );
  }
  function ModProveedor($id, $name, $stock, $price, $info, $cat_id, $pro_id)
  {
    include '../../connect.php';
    mysqli_query($conn, "UPDATE Productos SET name='$name', stock='$stock', price='$price', info='$info', Categorias_id='$cat_id', Proveedores_id='$pro_id' WHERE id='$id'");
    echo "<script>
      alert('Producto Actualizado Correctamente');
      window.top.frames['iframe_main'].location.reload();
    </script>";
  }
  ?>
  <script src="../../js/content.js"></script>
</body>

</html>
