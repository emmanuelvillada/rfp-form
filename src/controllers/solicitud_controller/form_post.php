<?php
include_once('../../db_conection/db_connection.php');
include_once('../../controllers/presupuesto_controller/presupuesto_controller.php');
include_once('../../controllers/archivo_controller/archivo_controller.php');
include_once('../../models/Solicitud.php');
include_once('../../models/Presupuesto.php');
include_once('../../models/Archivo.php');
include_once('../../controllers/solicitud_controller/solicitud_controller.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);  

echo "<pre>";
print_r($_POST);
echo "</pre>";

if (isset($_POST['submit'])) {
    // Imprimir el array $_POST
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'listar_solicitudes':
                if (isset($_POST['id_rfp_usuario_solicitud']) && isset($_POST['estado_rfp_solicitud'])) {
                    
                    $id_rfp_usuario_solicitud = $_POST['id_rfp_usuario_solicitud'];
                    $estado_rfp_solicitud = $_POST['estado_rfp_solicitud'];
                    echo $this->get_solicitudes($id_rfp_usuario_solicitud, $estado_rfp_solicitud);
                }
                
                break;
            case 'ver_solicitud':
                if (isset($_POST['id'])) {
                    echo $this->get_solicitud($_POST['id']);
                }
                break;
            case 'crear_solicitud':
                
                if (
                    isset($_POST['tipo_rfp_solicitud']) && isset($_POST['producto_servicio_rfp_solicitud']) && isset($_POST['tipo_presupuesto_rfp_presupuesto']) 
                    && isset($_POST['detalle_rfp_solicitud']) && isset($_POST['descripcion_rfp_solicitud']) && isset($_POST['fecha_requerimiento_rfp_solicitud'])
                )
                    {
                    $solicitud = new Solicitud();
                    $solicitud->__SET('id_rfp_usuario_solicitud', $_POST['id_rfp_usuario_solicitud']);
                    $solicitud->__SET('tipo_rfp_solicitud', $_POST['tipo_rfp_solicitud']);
                    $solicitud->__SET('fecha_creacion_rfp_solicitud', date("d/m/y"));
                    $solicitud->__SET('producto_servicio_rfp_solicitud', $_POST['producto_servicio_rfp_solicitud']);
                    $solicitud->__SET('detalle_rfp_solicitud', $_POST['detalle_rfp_solicitud']);
                    $solicitud->__SET('descripcion_rfp_solicitud', $_POST['descripcion_rfp_solicitud']);
                    $solicitud->__SET('fecha_requerimiento_rfp_solicitud', $_POST['fecha_requerimiento_rfp_solicitud']);
                    $solicitud->__SET('estado_rfp_solicitud', 1);
                    $solicitud->__SET('tipo_presupuesto_rfp_presupuesto', $_POST['tipo_presupuesto_rfp_presupuesto']);
                    // Dependiendo del tipo de presupuesto, capturar los datos correspondientes
                    $tipo_presupuesto = $solicitud->__GET('tipo_presupuesto_rfp_presupuesto');
                    if ($tipo_presupuesto === 'capex') {
                        // Si es Capex, capturar la RN y el monto del presupuesto
                        $rn = $_POST['seq_rn_rfp_presupuesto'];
                        $monto = $_POST['monto_rfp_presupuesto_seq'];
                        $id_ceco = null;
                        //se añaden los datos al objeto solicitud que se envia al controlador.
                        $solicitud->__SET('seq_rn_rfp_presupuesto', $rn);
                        $solicitud->__SET('monto_rfp_presupuesto', $monto);
                        $solicitud->__SET('id_rfp_centro_de_costo_area', $id_ceco);
                        
                    } elseif ($tipo_presupuesto === 'opex') {
                        // Si es Opex, capturar el CeCo y el monto del presupuesto
                        $ceco = $_POST['id_rfp_centro_de_costo_presupuesto'];
                        $monto = $_POST['monto_rfp_presupuesto_ceco'];
                        $seq_rn = null;
                        //se añaden los datos al objeto solicitud que se envia al controlador.
                        $solicitud->__SET('id_rfp_centro_de_costo_presupuesto', $ceco);
                        $solicitud->__SET('monto_rfp_presupuesto', $monto);
                        $solicitud->__SET('seq_rn_rfp_presupuesto', $seq_rn);
                    } elseif ($tipo_presupuesto === 'sobreejecucion') {
                        $ceco = null;
                        $monto = null;
                        $seq_rn = null;
                        //se añaden los datos al objeto solicitud que se envia al controlador.
                        $solicitud->__SET('id_rfp_centro_de_costo_presupuesto', $ceco);
                        $solicitud->__SET('monto_rfp_presupuesto', $monto);
                        $solicitud->__SET('seq_rn_rfp_presupuesto', $seq_rn);
                        
                    } 
                    
                    if (isset($_POST['riesgo_rfp_soliciutd'])){
                        $solicitud->__SET('riesgo_rfp_soliciutd',$_POST['riesgo_rfp_soliciutd']);
                    }else{
                        $solicitud->__SET('riesgo_rfp_soliciutd','n/a');
                    }
                    //capturamos el id de la solicitud para crear la instancia de los archivos relacionados con el id de la solicitud creada.
                    $presupuesto_controller = new presupuesto_controller();
                    $solicitud_controller = new solicitud_controller();
                    $id_solicitud = $solicitud_controller->create_solicitud($solicitud, $presupuesto_controller);

                    //guardamos los archivos si es que el usuario inserto en la tabla archivos relacionados con la fk de la solicitud
                    if (isset($_POST['archivos']))
                    {
                    $archivos = $_FILES['archivos'];
                    $num_archivos = count($archivos['name']);
                    $archivo_controller = new archivo_controller();
                
                    // Iterar sobre cada archivo adjunto
                    for ($i = 0; $i < $num_archivos; $i++) 
                        {
                        // Guardar el archivo en el sistema de archivos
                        $nombre_rfp_archivo = $archivos['name'][$i];
                        $ruta_temporal = $archivos['tmp_name'][$i];
                        $ruta_destino = "ruta/deseada/$nombre_rfp_archivo";
                        $tipo_rfp_archivo = $archivos['type'][$i];
                        $fecha_subida_rfp_archivo =  date("Y-m-d");
                        move_uploaded_file($ruta_temporal, $ruta_destino);
                
                        // Guardar la información del archivo en la base de datos
                        $archivo_controller->create($id_solicitud, $nombre_rfp_archivo, $tipo_rfp_archivo,$ruta_destino,$fecha_subida_rfp_archivo );
                        }
                    }
                }
            echo 'se creo una solicitud';
            
                break;
            case 'actualizar_solicitud':
                // Aquí iría el código para actualizar una solicitud
                break;
            case 'eliminar_solicitud':
                // Aquí iría el código para eliminar una solicitud
                break;
            default:
                echo "Acción no válida";
                break;
        }
    }
    
}



?>