<?php
session_start();

// Verificar si las credenciales de sesión existen
if (isset($_SESSION['usuario']) && isset($_SESSION['contraseña'])) {
    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];
    $id = $_SESSION['id'];


    echo "Usuario: $usuario <br>";
    echo "Contraseña: $contraseña";
} else {
    echo "Las credenciales de sesión no existen.";
}

?>
<?php
require_once '../../controllers/solicitud_controller/solicitud_controller.php';

// Crear una instancia del controlador
$solicitud_controller = new solicitud_controller();
//verificar si hay un id 
if (isset($_SESSION['documentoo'])) {
    $id_rfp_usuario_solicitud = $_SESSION['documento'];
} else {
    $id_rfp_usuario_solicitud = 1;
}
$estado = 'pendiente';
// Obtener las solicitudes
$solicitudes = $solicitud_controller->get_solicitudes_usuario($id_rfp_usuario_solicitud, $estado);
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
        <img class="logo-hwi" src="../../../public/images/Logo HWI .png" alt="">
        <div class="buttons">
            <a href="../index/index.php"><button class="button-volver">Volver al formulario</button></a>
        </div>
    </header>
    <main class="container-main">
        <h2 class="h2">Mis Solicitudes</h2>
        <div class="buttons">
            <button class="button-filtro" Onclick="mostrar_form(solicitudes_aceptadas)">Solicitudes Aceptadas</button>
            <button class="button-filtro" Onclick="mostrar_form(solicitudes_rechazadas)">Solicitudes Rechazadas</button>
            <button class="button-filtro" Onclick="mostrar_form(solicitudes_pendientes)">Solicitudes Pendientes</button>
        </div>


        <table id="form-solicitudes-aceptadas">
            <thead>
            <tr>
                <th>ID Solicitud</th>
                <th>Usuario</th>
                <th>Presupuesto</th>
                <th>Fase</th>
                <th>Fecha Creación</th>
                <th>Tipo</th>
                <th>Producto/Servicio</th>
                <th>Detalle</th>
                <th>Descripción</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($solicitudes as $solicitud) : ?>
                    <tr>
                        <td><?php echo $solicitud['id_rfp_solicitud']; ?></td>
                        <td><?php echo $solicitud['nombre_usuario'] . ' ' . $solicitud['apellido_usuario']; ?></td>
                        
                        <td><?php echo $solicitud['monto_rfp_presupuesto'] . ' (' . $solicitud['ceco_rfp_centro_de_costo'] . ')'; ?></td>
                        <td><?php echo $solicitud['nombre_rfp_fase']; ?></td>
                        <td><?php echo $solicitud['fecha_creacion_rfp_solicitud']; ?></td>
                        <td><?php echo $solicitud['tipo_rfp_solicitud']; ?></td>
                        <td><?php echo $solicitud['producto_servicio_rfp_solicitud']; ?></td>
                        <td><?php echo $solicitud['detalle_rfp_solicitud']; ?></td>
                        <td><?php echo $solicitud['descripcion_rfp_solicitud']; ?></td>
                        <td><?php echo $solicitud['estado_rfp_solicitud']; ?></td>
                        
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>


    </main>
</body>

<script src="script.js"></script>

</html>