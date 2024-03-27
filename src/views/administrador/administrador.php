<?php
session_start();
if (isset($_SESSION['id_area'])) {
    if ($_SESSION['id_area'] != 5) {
        header("Location: /../index/index.php");
        exit(); 
    }
}
require_once '../../controllers/solicitud_controller/solicitud_controller.php';

// Crear una instancia del controlador
$solicitud_controller = new solicitud_controller();

// Obtener las solicitudes
$solicitudes = $solicitud_controller->get_solicitudes();
$solicitudes = array_reverse($solicitudes);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrador RFP</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital
,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,
900&display=swap" rel="stylesheet" />
</head>

<body>
<header class="header">
        <img class="logo-hwi" src="../../../public\images\Logo HWI .png" alt="Logo HWI">
        <div class="buttons">
            <a href="../solicitudes_pendientes/solicitudes_pendientes.php"><button class="button-solicitudes-pendientes">Solicitudes Pendientes</button></a>
            <a href="../modificar_fase/modificar_fase.php"><button class="button-modificar-fase">Modificar fase de solicitud</button></a>
        </div>
    </header>
    <main class="container-main">
    <h1>Listado de Solicitudes Pendientes</h1>
    <table>
        <thead>
            <tr>
                <th>ID Solicitud</th>
                <th>Usuario</th>
                <th>Presupuesto</th>
                <th>Fecha Creación</th>
                <th>Tipo</th>
                <th>Producto/Servicio</th>
                <th>Detalle</th>
                <th>Descripción</th>
                <th>Estado</th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitud): ?>
                <tr onclick="window.location.href = '../detalle_solicitud/detalle_solicitud.php?id=<?php echo $solicitud['id_rfp_solicitud']; ?>'">
                    <td><?php echo $solicitud['id_rfp_solicitud']; ?></td>
                    <td><?php echo $solicitud['nombre_usuario'] . ' ' . $solicitud['apellido_usuario']; ?></td>
                    <td><?php echo $solicitud['monto_rfp_presupuesto'] . ' (' . $solicitud['ceco_rfp_centro_de_costo'] . ')'; ?></td>
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