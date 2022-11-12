<?php
$conn = new mysqli('localhost', 'root', '', 'sinmbas');
if ($conn->connect_errno){
  echo "No hay coneccion";
}
?>
