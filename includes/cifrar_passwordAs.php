<?php
require_once 'conexion.php';

$newPassword = password_hash('asistente', PASSWORD_DEFAULT); // Cifrar la contraseña
$sql = 'UPDATE usuarios SET password = ? WHERE identificador = ?';
$query = $pdo->prepare($sql);
$query->execute([$newPassword, 'asistente']);

echo "Contraseña actualizada correctamente.";
?>