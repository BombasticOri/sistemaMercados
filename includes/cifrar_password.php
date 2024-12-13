<?php
require_once 'conexion.php'; // Asegúrate de que la conexión a la base de datos esté bien establecida

// Consulta para obtener todos los usuarios sin contraseña cifrada
$sql = 'SELECT usuario_id, password FROM usuarios';
$query = $pdo->prepare($sql);
$query->execute();

$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

// Recorremos todos los usuarios
foreach ($usuarios as $usuario) {
    // Si la contraseña no está cifrada, ciframos y actualizamos
    if (!password_get_info($usuario['password'])['algo']) { // Si la contraseña no está cifrada
        $newPassword = password_hash($usuario['password'], PASSWORD_DEFAULT); // Cifrar la contraseña

        // Actualizar la contraseña en la base de datos
        $updateSql = 'UPDATE usuarios SET password = ? WHERE usuario_id = ?';
        $updateQuery = $pdo->prepare($updateSql);
        $updateQuery->execute([$newPassword, $usuario['usuario_id']]);
        
        echo "Contraseña para el usuario ID " . $usuario['usuario_id'] . " actualizada correctamente.<br>";
    }
}

echo "Proceso de actualización de contraseñas completado.";
?>
