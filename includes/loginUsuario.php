<?php

session_start(); // Iniciar sesión

if (!empty($_POST)) {
    if (empty($_POST['identificador']) || empty($_POST['password'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        require_once 'conexion.php'; // Incluye la conexión a la base de datos
        $identificador = $_POST['identificador'];
        $password = $_POST['password'];

        // Consulta para obtener el usuario y la contraseña
        $sql = 'SELECT * FROM mercado_gestion.usuarios AS u 
                INNER JOIN mercado_gestion.roles AS r 
                ON u.rol_id = r.rol_id 
                WHERE u.identificador = ?';
        $query = $pdo->prepare($sql); // Aquí se usa correctamente la conexión $pdo
        $query->execute(array($identificador));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($query->rowCount() > 0) {
            // Verificar si la contraseña necesita ser cifrada o rehashada
            if (password_needs_rehash($result['password'], PASSWORD_DEFAULT)) {
                // Si la contraseña no está cifrada o necesita ser rehashada, ciframos la nueva contraseña
                $newPassword = password_hash($password, PASSWORD_DEFAULT);

                // Actualizamos la contraseña en la base de datos
                $updateSql = 'UPDATE mercado_gestion.usuarios SET password = ? WHERE identificador = ?';
                $updateQuery = $pdo->prepare($updateSql);
                $updateQuery->execute([$newPassword, $identificador]);

                // Actualizamos el valor de la contraseña para continuar el proceso de verificación
                $result['password'] = $newPassword;
            }

            // Verificar la contraseña usando password_verify
            if (password_verify($password, $result['password'])) {
                // Almacenamos la sesión del usuario si las credenciales son correctas
                $_SESSION['active'] = true;
                $_SESSION['usuario_id'] = $result['usuario_id'];
                $_SESSION['nombre'] = $result['nombre'];
                $_SESSION['apellido'] = $result['apellido'];
                $_SESSION['rol'] = $result['rol_id'];
                $_SESSION['nombre_rol'] = $result['nombre_rol'];

                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button>Redirigiendo</div>';
            } else {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o contraseña incorrectas</div>';
            }
        } else {
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o contraseña incorrectas</div>';
        }
    }
}
?>
