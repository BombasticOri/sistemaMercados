<?php
require_once '../../../includes/conexion.php';

$sql = 'SELECT u.*, r.nombre_rol 
        FROM usuarios AS u 
        INNER JOIN roles AS r 
        ON u.rol_id = r.rol_id
        WHERE u.estado != 0';
$query = $pdo->prepare($sql);
$query->execute();

$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($consulta); $i++) {
    if ($consulta[$i]["estado"] == 1) {
        $estado = '<span class="badge text-bg-success">Activo</span>';
    } elseif ($consulta[$i]["estado"] == 2) {
        $estado = '<span class="badge text-bg-danger">Inactivo</span>';
    } else {
        unset($consulta[$i]);
        continue;
    }
    $consulta[$i]["estado"] = $estado;

    $consulta[$i]["acciones"] = '
        <button class="btn btn-primary" title="Editar" onclick="editarUsuario(' . $consulta[$i]['usuario_id'] . ')">Editar</button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminarUsuario(' . $consulta[$i]['usuario_id'] . ')">Eliminar</button>';
}

$consulta = array_values($consulta);

header('Content-Type: application/json');
echo json_encode($consulta, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>



<?php
    /* if($consulta[$i]["estado"] == 1){
        $consulta[$i]["estado"] = '<span class="badge badge-success">Activo</span>';
    }else{
        $consulta[$i]["estado"] = '<span class="badge badge-danger">Inactivo</span>';
    }

    $consulta[$i]["acciones"] = '
            <button class="btn btn-primary" title="Editar" onclick="editarUsuario('.$consulta[$i]['usuario_id'].')">Editar</button>
            <button class="btn btn-danger" title="Eliminar" onclick="eliminarUsuario('.$consulta[$i]['usuario_id'].')">Eliminar</button>
            ';
}
echo json_encode($consulta,JSON_UNESCAPED_UNICODE);*/
?>