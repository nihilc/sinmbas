<?php
DelUsuario($_GET['id']);
function DelUsuario($id)
{
  include '../../connect.php';
  mysqli_query($conn, "DELETE FROM Usuarios WHERE id=$id");
}
?>
<script>
  alert("Producto eliminado Correctamente");
  window.top.frames['iframe_main'].location.reload();
</script>
