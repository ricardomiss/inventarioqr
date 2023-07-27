<?php
#Se hace la conexion a la BD usando el servidor,nombre de usuario,contraseña y nombre de la BD
$conexion=new mysqli("localhost","id18425440_local","Admin123?123","id18425440_altepetl");
#la conexion se hace en utf8 para que no haya problemas con los acentos
$conexion->set_charset("utf8mb4_unicode_ci");
?>