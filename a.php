<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Permitir CORS
$servername = "localhost";
$username = "root";
$password = "root";
$db = "clientes";
$conn = new mysqli($servername, $username, $password, $db);
// Comprobar conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Conexión fallida: ' . $conn->connect_error]);
    exit;
}
$data = json_decode(file_get_contents('php://input'), true);
// Verificar que se recibió el JSON
if ($data === null) {
    echo json_encode(['success' => false, 'error' => 'Error al decodificar JSON']);
    exit;
}
 
if (isset($data['nombres'], $data['apellidos'])) {
    $nombre = $data['nombres'];
    $apellido = $data['apellidos'];
 
    $stmt = $conn->prepare("INSERT INTO registro.clientes (nombre, apellido) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre, $apellido);
 
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    } 
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Datos faltantes']);
}
 
$conn->close();
?>
