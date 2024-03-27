<?php
include_once('../../db_conection/db_connection.php');
include_once('../../controllers/presupuesto_controller/presupuesto_controller.php');
include_once('../../controllers/archivo_controller/archivo_controller.php');
include_once('../../models/Solicitud.php');
include_once('../../models/Presupuesto.php');
include_once('../../models/Archivo.php');
include_once('../../controllers/solicitud_controller/solicitud_controller.php');
include_once('../../controllers/correo_controller/correo_controller.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);



if (isset($_POST['submit'])) {
    // Imprimir el array $_POST
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {

            case 'crear_solicitud':

                if (
                    isset($_POST['tipo_rfp_solicitud']) && isset($_POST['producto_servicio_rfp_solicitud']) && isset($_POST['tipo_presupuesto_rfp_presupuesto'])
                    && isset($_POST['detalle_rfp_solicitud']) && isset($_POST['descripcion_rfp_solicitud']) && isset($_POST['fecha_requerimiento_rfp_solicitud'])
                ) {
                    $presupuesto = new Presupuesto();
                    $solicitud = new Solicitud();
                    $solicitud->__SET('id_rfp_usuario_solicitud', $_POST['id_rfp_usuario_solicitud']);
                    $solicitud->__SET('tipo_rfp_solicitud', $_POST['tipo_rfp_solicitud']);
                    $solicitud->__SET('fecha_creacion_rfp_solicitud', date("d/m/y"));
                    $solicitud->__SET('producto_servicio_rfp_solicitud', $_POST['producto_servicio_rfp_solicitud']);
                    $solicitud->__SET('detalle_rfp_solicitud', $_POST['detalle_rfp_solicitud']);
                    $solicitud->__SET('descripcion_rfp_solicitud', $_POST['descripcion_rfp_solicitud']);
                    $solicitud->__SET('fecha_requerimiento_rfp_solicitud', $_POST['fecha_requerimiento_rfp_solicitud']);
                    $solicitud->__SET('estado_rfp_solicitud', 'pendiente');
                    $presupuesto->__SET('tipo_presupuesto_rfp_presupuesto', $_POST['tipo_presupuesto_rfp_presupuesto']);
                    // Dependiendo del tipo de presupuesto, capturar los datos correspondientes
                    $tipo_presupuesto = $presupuesto->__GET('tipo_presupuesto_rfp_presupuesto');
                    if ($tipo_presupuesto === 'capex') {
                        // Si es Capex, capturar la RN y el monto del presupuesto
                        $rn = $_POST['seq_rn_rfp_presupuesto'];
                        $monto = $_POST['monto_rfp_presupuesto_seq'];
                        $id_ceco = null;
                        //se añaden los datos al objeto solicitud que se envia al controlador.
                        $presupuesto->__SET('seq_rn_rfp_presupuesto', $rn);
                        $presupuesto->__SET('monto_rfp_presupuesto', $monto);
                        $presupuesto->__SET('id_rfp_centro_de_costo_presupuesto', $id_ceco);
                    } elseif ($tipo_presupuesto === 'opex') {
                        // Si es Opex, capturar el CeCo y el monto del presupuesto
                        $ceco = $_POST['id_rfp_centro_de_costo_presupuesto'];
                        $monto = $_POST['monto_rfp_presupuesto_ceco'];
                        $seq_rn = null;
                        //se añaden los datos al objeto solicitud que se envia al controlador.
                        $presupuesto->__SET('id_rfp_centro_de_costo_presupuesto', $ceco);
                        $presupuesto->__SET('monto_rfp_presupuesto', $monto);
                        $presupuesto->__SET('seq_rn_rfp_presupuesto', $seq_rn);
                    } elseif ($tipo_presupuesto === 'sobreejecucion') {
                        $ceco = null;
                        $monto = null;
                        $seq_rn = null;
                        //se añaden los datos al objeto solicitud que se envia al controlador.
                        $presupuesto->__SET('id_rfp_centro_de_costo_presupuesto', $ceco);
                        $presupuesto->__SET('monto_rfp_presupuesto', $monto);
                        $presupuesto->__SET('seq_rn_rfp_presupuesto', $seq_rn);
                    }

                    if (isset($_POST['riesgo_rfp_soliciutd'])) {
                        $solicitud->__SET('riesgo_rfp_soliciutd', $_POST['riesgo_rfp_soliciutd']);
                    } else {
                        $solicitud->__SET('riesgo_rfp_soliciutd', 'n/a');
                    }
                    //capturamos el id de la solicitud para crear la instancia de los archivos relacionados con el id de la solicitud creada.
                    $presupuesto_controller = new presupuesto_controller();
                    $solicitud_controller = new solicitud_controller();
                    // $correo_controller = new correo_controller();
                    $id_solicitud = $solicitud_controller->create_solicitud($solicitud, $presupuesto_controller, $presupuesto);

                    //guardamos los archivos si es que el usuario inserto en la tabla archivos relacionados 
                    if (isset($_FILES['archivos'])) {
                        $archivos = $_FILES['archivos'];
                        $num_archivos = count($archivos['name']);
                        $archivo_controller = new archivo_controller();

                        // Iterar sobre cada archivo adjunto
                        for ($i = 0; $i < $num_archivos; $i++) {
                            //crear los atributos del archivo
                            $nombre_rfp_archivo = $archivos['name'][$i];
                            $nombre_sin_extension = pathinfo($nombre_rfp_archivo, PATHINFO_FILENAME);
                            $extension = pathinfo($nombre_rfp_archivo, PATHINFO_EXTENSION);
                            // Generar un nombre único para el archivo
                            $nombre_unico = $nombre_sin_extension . '_' . time() . '.' . $extension;
                            $ruta_temporal = $archivos['tmp_name'][$i];
                            $ruta_destino = "C:/xampp/htdocs/archivos/$nombre_unico";
                            $tipo_rfp_archivo = $archivos['type'][$i];
                            $fecha_subida_rfp_archivo =  date("d/m/y");
                            move_uploaded_file($ruta_temporal, $ruta_destino);

                            // Guardar la información del archivo en la base de datos
                            $archivo_controller->create($id_solicitud, $nombre_unico, $tipo_rfp_archivo, $ruta_destino, $fecha_subida_rfp_archivo);
                        }
                    }
                    //enviar correo al equipo de negociacion, notificando la creacion de una nueva solicitud
                
                $correo_controller = new correo_controller();
                $correo_destinatario = 'emmanuelvillada1903@gmail.com';
                $tema = 'Asunto : Notificacion RFP';
                $contenido = 'Se ha generado una nueva solicitud RFP';
                $correoEnviado = $correo_controller->enviar_correo($correo_destinatario, $tema, $contenido);
            if ($correoEnviado) {

                header("Location: ../../views/mis_solicitudes/mis_solicitudes.php");
                exit;
            } else {
                echo 'no se envia el correo';
            }
                }
                

                break;
        }
    }
}
