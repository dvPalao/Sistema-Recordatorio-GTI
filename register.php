<?php
$servername = "localhost"; 
$username = "usuario"; 
$password = "contrasena"; 
$dbname = "basededatos"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$contrasena = $_POST['contrasena'];
$confirmar_contrasena = $_POST['confirmar_contrasena'];
$genero = $_POST['genero'];

if ($contrasena !== $confirmar_contrasena) {
    die("Las contraseñas no coinciden.");
}

$stmt = $conn->prepare("INSERT INTO usuarios (nombre, usuario, email, telefono, contrasena, genero) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nombre, $usuario, $email, $telefono, password_hash($contrasena, PASSWORD_DEFAULT), $genero);

if ($stmt->execute()) {
    exit;
} else {
    echo "Error al registrar usuario: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>