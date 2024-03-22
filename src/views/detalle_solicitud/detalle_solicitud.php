<?php
session_start();

// Definir $solicitud fuera del bloque if e inicializarlo como un array vacío


require_once '../../controllers/solicitud_controller/solicitud_controller.php';

// Crear una instancia del controlador
$solicitud = [];

if (isset($_GET['id'])) {
    $id_solicitud = $_GET['id'];

    $solicitud_controller = new solicitud_controller();

    // Obtener la solicitud
    $solicitud = $solicitud_controller->get_solicitud($id_solicitud);
    
}
// Cerrar el bloque PHP antes de comenzar el HTML
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Solicitud</title>
    <!-- Agrega tus enlaces a hojas de estilo y otros recursos aquí -->
</head>
<body>
    
    <h1>Detalle de Solicitud</h1>
    <ul>
        <?php if (!empty($solicitud)): ?>
            <?php $solicitud_data = $solicitud[0]; ?> 
            <?php var_dump($solicitud);?>
            <?php echo $solicitud_data['id_rfp_solicitud']; ?>
            <li>ID Solicitud: <?php echo $solicitud_data['id_rfp_solicitud']; ?></li>
            <li>Usuario: <?php echo $solicitud_data['nombre_usuario']; ?></li>
            <li>Presupuesto: <?php echo $solicitud_data['monto_rfp_presupuesto']; ?> (Tipo: <?php echo $solicitud_data['tipo_presupuesto']; ?>)</li>
            <li>Fecha Creación: <?php echo $solicitud_data['fecha_creacion_rfp_solicitud']; ?></li>
            <li>Fecha Revisión: <?php echo $solicitud_data['fecha_revision_rfp_solicitud']; ?></li>
            <li>Fecha Requerimiento: <?php echo $solicitud_data['fecha_requerimiento_rfp_solicitud']; ?></li>
            <li>Fecha Finalización: <?php echo $solicitud_data['fecha_finalizacion_rfp_solicitud']; ?></li>
            <li>Tipo: <?php echo $solicitud_data['tipo_rfp_solicitud']; ?></li>
            <li>Producto/Servicio: <?php echo $solicitud_data['producto_servicio_rfp_solicitud']; ?></li>
            <li>Detalle: <?php echo $solicitud_data['detalle_rfp_solicitud']; ?></li>
            <li>Descripción: <?php echo $solicitud_data['descripcion_rfp_solicitud']; ?></li>
            <li>Estado: <?php echo $solicitud_data['estado_rfp_solicitud']; ?></li>
            <li>Riesgo: <?php echo $solicitud_data['riesgo_rfp_solicitud']; ?></li>
            <?php if (!empty($solicitud_data['ceco_rfp_centro_de_costo']) && !empty($solicitud_data['nombre_centro_costo'])): ?>
                <li>Centro de Costo: <?php echo $solicitud_data['ceco_rfp_centro_de_costo'] . ' (' . $solicitud_data['nombre_centro_costo'] . ')'; ?></li>
            <?php endif; ?>
        <?php else: ?>
            <li>No hay información de solicitud disponible</li>
        <?php endif; ?>
    </ul>
</body>
</html>

