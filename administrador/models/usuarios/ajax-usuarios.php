<?php

require_once '../../../includes/conexion.php';

if (!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['email']) || empty($_POST['identificador']) || empty($_POST['password'])) {
        $respuesta = array('status' => false, 'msg' => 'Todos los campos son obligatorios');
    } else {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $identificador = $_POST['identificador'];
        $password = $_POST['password'];
        $rol_id = $_POST['listRol'];
        $estado = $_POST['listEstado'];

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'SELECT * FROM usuarios WHERE identificador = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($identificador));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result > 0) {
            $respuesta = array('status' => false, 'msg' => 'El usuario ya existe');
        } else {
            $sqlInsert = 'INSERT INTO usuarios (nombre, apellido, email, identificador, password, rol_id, estado) VALUES (?, ?, ?, ?, ?, ?, ?)'; // Cambiado a rol_id
            $queryInsert = $pdo->prepare($sqlInsert);
            $resultInsert = $queryInsert->execute(array($nombre, $apellido, $email, $identificador, $password, $rol_id, $estado));

            if ($resultInsert) {
                $respuesta = array('status' => true, 'msg' => 'Usuario creado correctamente');
            } else {
                $respuesta = array('status' => false, 'msg' => 'Error al crear Usuario');
            }
        }
    }
}

echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

?>
