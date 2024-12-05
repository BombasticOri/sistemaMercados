<?php

if(!empty($_POST)) {
    if(!empty($_POST['login']) || empty($_POST['pass'])) {
        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Todos los campos son necesarios</div>';
    }else{
        require_once 'conexion.php';
        $login - $_POST['login'];
        $pass - $_POST['pass'];

        $sql = 'SELECT * FROM administrador as u INNER JOIN rol as r ON u.rol = r.rol_id WHERE u.administrador = ?';
        $query = $pdo->prepare($sql);
        $query->execute(array($login));
        $result - $query->fetch(PDO::FETCH_ASSOC);
        
        if($query->rowCount() > 0){
            if(password_verify($pass, $result['clave'])){
                $_SESSION['active'] = true;
                $_SESSION['id_administrador'] = $result['administrador_id'];
                $_SESSION['nombre'] = $result['administrador'];
                $_SESSION['rol'] = $result['rol_id'];
                $_SESSION['nombre_rol'] = $result['nombre_rol'];

                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button>Redirigiendo</div>'; 
            }else {
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>Usuario o contraseña incorrectas</div>';
            }
        }else {
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button>Usuario o contraseña incorrectas</div>';
        }
    }
}