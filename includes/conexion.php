<?php
$host = 'localhost';
$port = '3307';
$dbname = 'mercado_gestion';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*echo "Conexión exitosa a la base de datos.";*/
} catch (PDOException $e) {
    die('Error al conectar a la base de datos: ' . $e->getMessage());
}
?>