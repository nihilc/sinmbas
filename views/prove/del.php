<?php
DelProveedor($_GET['id']);
function DelProveedor($id)
{
  include '../../connect.php';
  mysqli_query($conn, "DELETE FROM Proveedores WHERE id=$id");
}
?>
<script>
  alert("Proveedor eliminado Correctamente");
  window.top.frames['iframe_main'].location.reload();
</script>
