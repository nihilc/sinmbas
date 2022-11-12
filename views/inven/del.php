<?php
DelProducto($_GET['id']);
function DelProducto($id)
{
  include '../../connect.php';
  mysqli_query($conn, "DELETE FROM Productos WHERE id=$id");
}
?>
<script>
  alert("Producto eliminado Correctamente");
  window.top.frames['iframe_main'].location.reload();
</script>
