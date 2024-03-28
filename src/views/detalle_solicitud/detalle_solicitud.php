<?php
session_start();
if (isset($_SESSION['id_area'])) {
    if ($_SESSION['id_area'] != 5) {
        header("Location: /../index/index.php");
        exit();
    }
}
require_once '../../controllers/solicitud_controller/solicitud_controller.php';
require_once '../../controllers/archivo_controller/archivo_controller.php';
// Definir $solicitud fuera del bloque if e inicializarlo como un array vacío

$solicitud = [];

//recibir el id de la solicitud
if (isset($_GET['id'])) {
    $id_solicitud = $_GET['id'];
    // Crear una instancia del controlador
    $solicitud_controller = new solicitud_controller();

    // Obtener la solicitud
    $solicitud = $solicitud_controller->get_solicitud($id_solicitud);

    //crear instancia del controlador de archivos
    $archivo_controller = new archivo_controller();
    $archivos = $archivo_controller->get_archivos($id_solicitud);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Solicitud</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital
,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,
900&display=swap" rel="stylesheet" />
</head>
<header class="header">
    <img class="logo-hwi" src="../../../public\images\Logo HWI .png" alt="Logo HWI">
    <div class="buttons">
        <a href="../administrador/administrador.php"><button class="button-volver">Volver</button></a>
    </div>
</header>

<body>
    <main class="container">
        <h1>Detalle de Solicitud</h1>
        <ul>
            <?php if (!empty($solicitud)) : ?>
                <?php $solicitud_data = $solicitud[0]; ?>
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
                <?php if (!empty($solicitud_data['ceco_rfp_centro_de_costo']) && !empty($solicitud_data['nombre_centro_costo'])) : ?>
                    <li>Centro de Costo: <?php echo $solicitud_data['ceco_rfp_centro_de_costo'] . ' (' . $solicitud_data['nombre_centro_costo'] . ')'; ?></li>
                <?php endif; ?>
            <?php else : ?>
                <li>No hay información de solicitud disponible</li>
            <?php endif; ?>
        </ul>
        <!-- Formulario para actualizar la subcategoría -->
        <div id="subcategoria-container">
            <!-- Campo de entrada de la subcategoría -->
            <label for="subcategoria">Subcategoría:</label>
            <select name="subcategoria" id="subcategoria-select">
                <?php
                require_once('../../controllers/subcategoria_controller/subcategoria_controller.php');

                $subcategoria_controller = new subcategoria_controller();

                $subcategorias = $subcategoria_controller->get();
                // Verificar si se obtuvieron resultados
                if (!empty($subcategorias)) {
                    var_dump($subcategorias);
                    foreach ($subcategorias as $subcategoria) {
                        echo '<option value="' . $subcategoria['id_rfp_subcategoria'] . '">' . $subcategoria['nombre_rfp_subcategoria'] . '(' . $subcategoria['nombre_usuario_subcategoria'] . ')' . '</option>';
                    }
                    
                } else {
                    echo '<option value="0">No hay centros de costo disponibles</option>';
                }
                
                ?>
            </select>
        </div>

        <h2>Archivos de la Solicitud</h2>
        <ul>
            <?php
            // Obtener los archivos relacionados a la solicitud

            // Verificar si hay archivos
            if (!empty($archivos)) {
                // Iterar sobre cada archivo y mostrar un enlace para descargar o visualizar
                foreach ($archivos as $archivo) {
                    $nombre_archivo = $archivo['nombre_rfp_archivo'];
                    // Generar la ruta relativa al archivo dentro de la carpeta "archivos"
                    $ruta_archivo = '../../../../../archivos/' . $archivo['nombre_rfp_archivo'];
                    echo "<li><a href='$ruta_archivo' target='_blank'>$nombre_archivo</a></li>";
                }
            } else {
                echo "<li>No hay archivos asociados a esta solicitud</li>";
            }
            ?>
        </ul>



        <div class="button-container">
            <button type="button" class="btn btn-aceptar" onclick="aceptar()">Aceptar</button>
            <button type="button" class="btn btn-rechazar" onclick="updateEstado('rechazada',null)">Rechazar</button>

        </div>
    </main>
</body>

</html>
<script>
    function aceptar() {
        var subcategoriaSelect = document.getElementById("subcategoria-select");
        var subcategoria = subcategoriaSelect.options[subcategoriaSelect.selectedIndex].value;

        // Verificar si se ha ingresado una subcategoría
        if (subcategoria !== '0') {

            // Llamar a la función para actualizar el estado con 'aceptada'
            updateEstado('aceptada', subcategoria);
        } else {
            // Mostrar un mensaje de error o tomar otra acción según sea necesario
            alert("Por favor selecciona una subcategoría.");
        }
    }

    function updateEstado(estado, subcategoria_solicitud) {
        var idSolicitud = <?php echo $solicitud_data['id_rfp_solicitud']; ?>;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText); // Muestra el mensaje de éxito o error
                window.location.href = "../administrador/administrador.php"; // Recargar la página después de actualizar el estado
            }
        };
        // Enviar los datos por POST al archivo ajax_handler.php
        xhttp.open("POST", "../../controllers/solicitud_controller/detalle_solicitud_post.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id_solicitud=" + idSolicitud + "&estado=" + estado + "&subcategoria=" + subcategoria_solicitud);
    }
</script>