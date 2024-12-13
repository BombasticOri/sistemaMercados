<?php
$host = 'localhost';
$port = '3307'; // Puerto de MySQL
$dbname = 'mercado_gestion'; // Nombre de tu base de datos
$user = 'root'; // Usuario de MySQL
$password = ''; // Contraseña de MySQL (cámbiala si root tiene una)

try {
    // Incluye el puerto en la conexión
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error al conectar a la base de datos: ' . $e->getMessage());
}
?>