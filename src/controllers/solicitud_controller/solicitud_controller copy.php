<?php
include_once('../../db_conection/db_connection.php');
include_once('../presupuesto_controller/presupuesto_controller.php');
include_once('../archivo_controller/archivo_controller.php');
include_once('../../models/Solicitud.php');
include_once('../../models/Presupuesto.php');
include_once('../../models/Archivo.php');
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);  

        $db_connection;
        $db_connection = new db_connection();
        $pdo = $db_connection->pdo;

    
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se ha enviado la acción específica para crear una solicitud
        if (isset($_POST['action']) && $_POST['action'] === 'crear_solicitud') {
            if (
                isset($_POST['tipo_rfp_solicitud']) && isset($_POST['producto_servicio_rfp_solicitud']) && isset($_POST['tipo_presupuesto_rfp_presupuesto']) && isset($_POST['detalle_rfp_solicitud'])
                && isset($_POST['descripcion_rfp_solicitud'])) 
                {
                $solicitud = new Solicitud();
                $solicitud->__SET('id_rfp_usuario_solicitud', $_POST['id_rfp_usuario_solicitud']);
                $solicitud->__SET('tipo_rfp_solicitud', $_POST['tipo_rfp_solicitud']);
                $solicitud->__SET('fecha_creacion_rfp_solicitud', date("d-m-y"));
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
                    $monto = $_POST['monto_rfp_presupuesto'];
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
                $id_solicitud = $this->create_solicitud($solicitud, $presupuesto_controller);

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
            
            try {
                $presupuesto = new Presupuesto();
                //todos los atributos de presupuesto, para enviar el objeto al controlador.
                $presupuesto->__SET('tipo_presupuesto_rfp_presupuesto', $data->tipo_presupuesto_rfp_presupuesto);
                $presupuesto->__SET('seq_rn_rfp_presupuesto', $data->seq_rn_rfp_presupuesto);
                $presupuesto->__SET('id_rfp_centro_de_costo_presupuesto', $data->id_rfp_centro_de_costo_presupuesto);
                $presupuesto->__SET('monto_rfp_presupuesto', $data->monto_rfp_presupuesto);
    
                // Crear el presupuesto antes de crear la solicitud utilizando el controlador de presupuestos
                $id_presupuesto = $presupuesto_controller->create_presupuesto($presupuesto);
                $data->__SET('id_rfp_presupuesto_solicitud', $id_presupuesto);
    
                //se debe crear primero el presupuesto con el controlador de presupuesto
                $sql = "INSERT INTO smart_center_rfp_solicitudes (
                    id_rfp_usuario_solicitud,
                    id_rfp_presupuesto_solicitud,
                    fecha_creacion_rfp_solicitud,
                    fecha_requerimiento_rfp_solicitud,
                    tipo_rfp_solicitud,
                    producto_servicio_rfp_solicitud,
                    detalle_rfp_solicitud,
                    descripcion_rfp_solicitud,
                    estado_rfp_solicitud,
                    riesgo_rfp_solicitud
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $pdo->prepare($sql)->execute(array(
                    $data->__GET('id_rfp_usuario_solicitud'),
                    $data->__GET('id_rfp_presupuesto_solicitud'),
                    $data->__GET('fecha_creacion_rfp_solicitud'),
                    $data->__GET('fecha_requerimiento_rfp_solicitud'),
                    $data->__GET('tipo_rfp_solicitud'),
                    $data->__GET('producto_servicio_rfp_solicitud'),
                    $data->__GET('detalle_rfp_solicitud'),
                    $data->__GET('descripcion_rfp_solicitud'),
                    $data->__GET('estado_rfp_solicitud'),
                    $data->__GET('riesgo_rfp_soliciutd')
                ));
                var_dump($data);
                return $pdo->lastInsertId();
                
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

?>

