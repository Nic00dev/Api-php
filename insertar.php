<?php
// Establecemos el tipo de contenido como JSON para que Android sepa qué respuesta recibe
header('Content-Type: application/json; charset=utf-8');

// Parámetros de conexión a la base de datos
$host = "localhost";  // usualmente localhost en XAMPP
$user = "root";       // usuario por defecto de MySQL en XAMPP
$pass = "";           // normalmente vacío en XAMPP
$db = "prueba";      // nombre de tu base de datos

// Crear conexión con MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    // Si falla conexión, devolver error
    echo json_encode(["success" => false, "message" => "Error de conexión: " . $conn->connect_error]);
    exit();
}

// Obtener datos enviados por POST (usando application/x-www-form-urlencoded o form-data)
$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? $conn->real_escape_string($_POST['apellido']) : '';

// Validar que no estén vacíos
if (empty($nombre) || empty($apellido)) {
    echo json_encode(["success" => false, "message" => "Faltan parámetros"]);
    exit();
}

// Crear la consulta SQL para insertar
$sql = "INSERT INTO personas (nombre, apellido) VALUES ('$nombre', '$apellido')";

// Ejecutar la consulta y verificar si fue exitosa
if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Usuario insertado correctamente"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al insertar: " . $conn->error]);
}

// Cerrar conexión
$conn->close();
?>

