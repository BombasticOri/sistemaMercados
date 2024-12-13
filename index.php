<?php
    session_start();
    if(!empty($_SESSION['active'])){
        header('location: administrador/');
    } else if(!empty($_SESSION['activeP'])){
        header('loaction: usuario/');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Ingreso al Sistema</title>
</head>
<body>
    <header class="main-header">
        <div class="main-cont">
            <div class="desc-header">
                <img src="images/MUNICIPALIDAD_SAN_MIGUEL.jpg" alt="Logo Municipalidad">
            </div>
        </div>   
        <div class="cont-header">
            <h1 class="text-center">Bienvenido(a)</h1>
            <div class="form">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Administrador</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Usuario</button>
                    </li>
                </ul> 
                <div class="tab-content" id="myTabContent">
                    <!-- Formulario Administrador -->
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <form id="adminForm">
                            <div class="mb-3">
                                <label for="adminIdentificador" class="form-label">Identificador</label>
                                <input type="text" class="form-control" name="identificador" id="adminIdentificador" placeholder="Nombre de usuario" required autocomplete="username">
                            </div>
                            <div class="mb-3">
                                <label for="adminPassword" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="adminPassword" placeholder="Contraseña" autocomplete="current-password" required autocomplete="current-password">
                            </div>
                            <div id="messageAdmin"></div>
                            <button id="loginAdmin" type="button" class="btn btn-primary w-100">Iniciar Sesión</button>
                        </form>
                    </div>
                    <!-- Formulario Usuario -->
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <form id="userForm">
                            <div class="mb-3">
                                <label for="userIdentificador" class="form-label">Identificador</label>
                                <input type="text" class="form-control" name="identificador" id="userIdentificador" placeholder="Nombre de usuario" required autocomplete="username">
                            </div>
                            <div class="mb-3">
                                <label for="userPassword" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="userPassword" placeholder="Contraseña" autocomplete="current-password" required autocomplete="current-password">
                            </div>
                            <div id="messageUsuario"></div>
                            <button id="loginUsuario" type="button" class="btn btn-primary w-100">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>
