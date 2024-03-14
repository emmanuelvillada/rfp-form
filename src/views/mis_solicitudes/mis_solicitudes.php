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
        <div class="button-filtro">
            <button Onclick="mostrar_form(solicitudes_aceptadas)">Solicitudes Aceptadas</button>
            <button Onclick="mostrar_form(solicitudes_rechazadas)">Solicitudes Rechazadas</button>
            <button Onclick="mostrar_form(solicitudes_pendientes)">Solicitudes Pendientes</button>
        </div>
        
        <table id="form-complete">
            <thead>
                <tr>
                    <th>Id solicitud</th>
                    <th>fase</th>
                    <th>Fecha creacion</th>
                    <th>Fecha de requerimiento </th>
                    <th>Tipo </th>
                    <th>Producto o servicio</th>
                    <th>Detalle</th>
                    <th>Descripcion</th>
                    <th>Necesidad</th>
                    <th>Comentario</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        02/02/2024
                    </td>
                    <td>
                        15/02/2024
                    </td>
                    <td>
                        Puntual
                    </td>
                    <td>
                        Producto
                    </td>
                    <td>
                        varilla de metal para sostener caja
                    </td>
                    <td>
                        Una varilla de 20x5 cm de metal
                    </td>
                    <td>
                        Se necesita para el area de mantenimiento
                    </td>
                    <td>
                        Se precisa notificar al area de sst
                    </td>
                    <td><button class ="button-eliminar" type="button">Eliminar</button></td>
                </tr>
            </tbody>
            
        </table>
        <table id="form-solicitudes-aceptadas">
            <thead>
                <tr>
                    <th>Id solicitud</th>
                    <th>fase</th>
                    <th>Fecha creacion</th>
                    <th>Fecha de requerimiento </th>
                    <th>Tipo </th>
                    <th>Producto o servicio</th>
                    <th>Detalle</th>
                    <th>Descripcion</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
if(isset($_SESSION['id_rfp_usuario_solicitud'])) {
    $id_rfp_usuario_solicitud = $_SESSION['id_rfp_usuario_solicitud'];
    $solicitud_controller = new solicitud_controller();
    // se puede cambiar el parametro que se le enviara a el metodo get-SOLICITUD
    $solicitudes_aceptadas = $solicitud_controller->get_solicitud($id_rfp_usuario_solicitud, "aceptada");
    foreach ($solicitudes_aceptadas as $solicitud) {
        echo '<tr>';
        echo '<td>' . $solicitud->__GET('id_rfp_solicitud') . '</td>';
        echo '<td>' . $solicitud->__GET('id_rfp_fase_solicitud') . '</td>';
        echo '<td>'. $solicitud->__GET('fecha_creacion_rfp_solicitud')'</td>'; // Este es solo un ejemplo, deberías obtener la fecha correcta de algún lugar
        echo '<td>'. $solicitud->__GET('fecha_requerimiento_rfp_solicitud')'</td>'; // Este es solo un ejemplo, deberías obtener la fecha correcta de algún lugar
        echo '<td>'. $solicitud->__GET('tipo_rfp_solicitud')'</td>'; // Este es solo un ejemplo, deberías obtener este dato de algún lugar
        echo '<td>'. $solicitud->__GET('producto_servicio_rfp_solicitud')'</td>'; // Este es solo un ejemplo, deberías obtener este dato de algún lugar
        echo '<td>'. $solicitud->__GET('detalle_rfp_solicitud')'</td>'; // Este es solo un ejemplo, deberías obtener este dato de algún lugar
        echo '<td>'. $solicitud->__GET('descripcion_rfp_solicitud')'</td>'; // Este es solo un ejemplo, deberías obtener este dato de algún lugar
        echo '</tr>';
    }
}
?>

            </tbody>
        </table>
        <table id="form-solicitudes-rechazadas">
            <thead>
                <tr>
                    <th>Id solicitud</th>
                    <th>fase</th>
                    <th>Fecha creacion</th>
                    <th>Fecha de requerimiento </th>
                    <th>Tipo </th>
                    <th>Producto o servicio</th>
                    <th>Detalle</th>
                    <th>Descripcion</th>
                    <th>Necesidad</th>
                    <th>Comentario</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        02/02/2024
                    </td>
                    <td>
                        15/02/2024
                    </td>
                    <td>
                        Puntual
                    </td>
                    <td>
                        Producto
                    </td>
                    <td>
                        varilla de metal para sostener caja
                    </td>
                    <td>
                        Una varilla de 20x5 cm de metal
                    </td>
                    <td>
                        Se necesita para el area de mantenimiento
                    </td>
                    <td>
                        Se precisa notificar al area de sst
                    </td>
                    <td><button class ="button-eliminar" type="button">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
        <table id="form-solicitudes-pendientes">
            <thead>
                <tr>
                    <th>Id solicitud</th>
                    <th>fase</th>
                    <th>Fecha creacion</th>
                    <th>Fecha de requerimiento </th>
                    <th>Tipo </th>
                    <th>Producto o servicio</th>
                    <th>Detalle</th>
                    <th>Descripcion</th>
                    <th>Necesidad</th>
                    <th>Comentario</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        1
                    </td>
                    <td>
                        02/02/2024
                    </td>
                    <td>
                        15/02/2024
                    </td>
                    <td>
                        Puntual
                    </td>
                    <td>
                        Producto
                    </td>
                    <td>
                        varilla de metal para sostener caja
                    </td>
                    <td>
                        Una varilla de 20x5 cm de metal
                    </td>
                    <td>
                        Se necesita para el area de mantenimiento
                    </td>
                    <td>
                        Se precisa notificar al area de sst
                    </td>
                    <td><button class ="button-eliminar" type="button">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
        
    </main>
</body>

<script src="script.js"></script>

</html>