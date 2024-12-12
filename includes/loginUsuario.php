<?php

session_start(); // Iniciar sesión

if (!empty($_POST)) {
    if (empty($_POST['identificador']) || empty($_POST['password'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    } else {
        require_once 'conexion.php'; // Incluye la conexión a la base de datos
        $identificador = $_POST['identificador'];
        $password = $_POST['password'];

        $sql = 'SELECT * FROM mercado_gestion.usuarios AS u 
                INNER JOIN mercado_gestion.roles AS r 
                ON u.rol_id = r.rol_id 
                WHERE u.identificador = ?';
        $query = $pdo->prepare($sql); // Aquí se usa correctamente la conexión $pdo
        $query->execute(array($identificador));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($query->rowCount() > 0) {
            if (password_verify($password, $result['password'])) {
                $_SESSION['activeP'] = true;
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