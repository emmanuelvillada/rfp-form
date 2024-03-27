<?php

require_once '../../controllers/solicitud_controller/solicitud_controller.php';


$solicitud_controller = new solicitud_controller();

// Verificar si se reciben los parámetros esperados por POST
if(isset($_POST['id_solicitud']) && isset($_POST['estado']) && isset($_POST['subcategoria'])) {
    // Recibir los datos enviados por AJAX
    $id_solicitud = $_POST['id_solicitud'];
    $estado = $_POST['estado'];
    $subcategoria = $_POST['subcategoria'];
    // Llamar a la función update_estado_solicitud con los datos recibidos
    $result = $solicitud_controller->update_estado_solicitud($id_solicitud, $estado);
    // Enviar una respuesta al cliente
    echo 'Solicitud '.$estado. ' exitosamente'; 
} else {
    // Enviar un mensaje de error si los parámetros esperados no están presentes
    echo "Error: Parámetros incompletos.";
}
?>
