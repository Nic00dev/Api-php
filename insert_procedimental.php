<?php
// Establecemos el tipo de contenido como JSON
header('Content-Type: application/json; charset=utf-8');

// Parámetros de conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db   = "prueba";

// Crear conexión (procedimental)
$conn = mysqli_connect($host, $user, $pass, $db);

// Verificar conexión
if (!$conn) {
    echo json_encode([
        "success" => false,
        "message" => "Error de conexión: " . mysqli_connect_error()
    ]);
    exit();
}

// Establecer charset UTF-8
mysqli_set_charset($conn, "utf8");

// Obtener datos enviados por POST
$nombre   = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';

// Validar que no estén vacíos
if (empty($nombre) || empty($apellido)) {
    echo json_encode([
        "success" => false,
        "message" => "Faltan parámetros"
    ]);
    exit();
}

// Preparar la sentencia (prepared statement)
$stmt = mysqli_prepare($conn, "INSERT INTO personas (nombre, apellido) VALUES (?, ?)");

// Verificar preparación
if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "Error en preparación: " . mysqli_error($conn)
    ]);
    exit();
}

// Enlazar parámetros (s = string)
mysqli_stmt_bind_param($stmt, "ss", $nombre, $apellido);

// Ejecutar la sentencia
if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "success" => true,
        "message" => "Usuario insertado correctamente"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Error al insertar: " . mysqli_stmt_error($stmt)
    ]);
}

// Cerrar la sentencia y la conexión
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
