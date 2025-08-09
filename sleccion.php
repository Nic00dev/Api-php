
<?php
$db="prueba";
$host="localhost";
$pw="root";
$user="root";
$com = mysqli_connect($host,$user,$pw);
mysqli_select_db($com,$db);
$query = "SELECT nombre, apellido FROM eje";
$result = mysqli_query($com, $query);

if (mysqli_num_rows($result) > 0) {
    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;  // Agregar cada fila al arreglo de respuesta
    }
    echo json_encode($response);  // Devolver el arreglo en formato JSON
} else {
    echo json_encode(array("message" => "No se encontraron registros"));
}
	//mysqli_close();
?>

