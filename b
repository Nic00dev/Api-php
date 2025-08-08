<?php
$db="prueba";
$host="localhost";
$pw="root";
$user="root";
$com = mysqli_connect($host,$user,$pw);
mysqli_select_db($com,$db);
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$apellido = isset($_GET['apellido']) ? $_GET['apellido'] : '';
mysqli_query( $com,"INSERT INTO eje(nombre, apellido) VALUES ('$nombre', '$apellido')") ;
echo "¡Gracias! Hemos recibido sus datos.\n";
?>
