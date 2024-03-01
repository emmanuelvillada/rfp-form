<?php
session_start();

// Verificar si las credenciales de sesión existen
if(isset($_SESSION['usuario']) && isset($_SESSION['contraseña'])) {
    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];
    $id = $_SESSION['id'];


    echo "Usuario: $usuario <br>";
    echo "Contraseña: $contraseña";
} else {
    echo "Las credenciales de sesión no existen.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis solicitudes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
        <h1>HWI logo </h1>
        <div class="buttons">
            <a href="../index/index.php"><button class="button-mis-solicitudes" >Volver al formulario</button></a>
        </div>
    </header>
    <main>
        <h2>Solicitudes</h2>
        <?php 
        include '../../controllers/solicitud_controller/SolicitudController.php';
        $solicitudes = new SolicitudController();

        $solicitudes_usuario = $solicitudes->get($id);

        echo
        ?>
    </main>
</body>
    
</html>