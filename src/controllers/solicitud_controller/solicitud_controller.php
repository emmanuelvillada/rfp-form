<?php
require_once '../../db_connection/db_connection.php';

class solicitud_controller
{
    private $db_connection;

    public function __construct()
    {
        $this->db_connection = new db_connection();
    }

    public function handle_request()
    {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'listar_solicitudes':
                    return $this->get_solicitudes();
                    break;
                case 'ver_solicitud':
                    if (isset($_POST['id'])) {
                        return $this->get_solicitud($_POST['id']);
                    }
                    break;
                case 'crear_solicitud':
                    if (
                        isset($_POST['tipo_rfp_solicitud']) && isset($_POST['producto_servicio_rfp_solicitud']) && isset($_POST['tipo_presupuesto_rfp_presupuesto']) && isset($_POST['detalle_rfp_solicitud'])
                    && isset($_POST['descripcion_rfp_solicitud'])) {
                        $solicitud = new Solicitud();
                        $solicitud->__SET('tipo_rfp_solicitud', $_POST['tipo_rfp_solicitud']);
                        $solicitud->__SET('producto_servicio_rfp_solicitud', $_POST['producto_servicio_rfp_solicitud']);
                        $solicitud->__SET('tipo_presupuesto_rfp_presupuesto', $_POST['tipo_presupuesto_rfp_presupuesto']);
                        // Dependiendo del tipo de presupuesto, capturar los datos correspondientes
                        $tipo_presupuesto = $solicitud->__GET('tipo_presupuesto_rfp_presupuesto');
                        if ($tipo_presupuesto === 'capex') {
                            // Si es Capex, capturar la RN y el monto del presupuesto
                            $rn = $_POST['seq_rn_rfp_presupuesto'];
                            $monto = $_POST['monto_rfp_presupuesto'];
                            //se añaden los datos al objeto solicitud que se envia al controlador.
                            $solicitud->__SET('seq_rn_rfp_presupuesto', $rn);
                            $solicitud->__SET('monto_rfp_presupuesto', $monto);
                        } elseif ($tipo_presupuesto === 'opex') {
                            // Si es Opex, capturar el CeCo y el monto del presupuesto
                            $ceco = $_POST['id_ rfp_centro_de_costo_presupuesto'];
                            $monto = $_POST['monto_rfp_presupuesto'];
                            //se añaden los datos al objeto solicitud que se envia al controlador.
                            $solicitud->__SET('id_ rfp_centro_de_costo_presupuesto', $ceco);
                            $solicitud->__SET('monto_rfp_presupuesto', $monto);
                        } elseif ($tipo_presupuesto === 'sobreejecucion') {
                            // Si es Sobreejecución, no se captura ningún dato adicional
                            
                        } 
                        $solicitud->__SET('detalle_rfp_solicitud', $_POST['detalle_rfp_solicitud']);
                        $solicitud->__SET('descripcion_rfp_solicitud', $_POST['descripcion_rfp_solicitud']);
                        $solicitud->__SET('fecha_requerimiento_rfp_solicitud', $_POST['fecha_requerimiento_rfp_solicitud']);
                        if (isset($_POST['riesgo_rfp_soliciutd'])){
                            $solicitud->__SET('riesgo_rfp_soliciutd',$_POST['riesgo_rfp_soliciutd']);
                        }else{
                            $solicitud->__SET('riesgo_rfp_soliciutd','n/a');
                        }
                        
                        //capturamos el id de la solicitud para crear la instancia de los archivos relacionados con el id de la solicitud creada.
                        $id_solicitud = $this->create_solicitud($solicitud);

                        if (isset($_POST['archivos']))
                        {
                        $archivos = $_FILES['archivos'];
                        $num_archivos = count($archivos['name']);
                        $archivo_controller = new archivo_controller();
                    
                        // Iterar sobre cada archivo adjunto
                        for ($i = 0; $i < $num_archivos; $i++) {
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
                
                
                    break;
                case 'actualizar_solicitud':
                    // Aquí iría el código para actualizar una solicitud
                    break;
                case 'eliminar_solicitud':
                    // Aquí iría el código para eliminar una solicitud
                    break;
                default:
                    return "Acción no válida";
                    break;
            }
        }
        return "No se especificó ninguna acción";
    }

    public function get_solicitudes()
    {
        $pdo  = $this->db_connection->pdo;
        try {
            $result = array();
            $stm = $this->$pdo->prepare("SELECT * FROM smart_center_rfp_solicitudes");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $alm = new Solicitud();
                $alm->__SET('id', $r->id);
                $alm->__SET('marca', $r->marca);
                $alm->__SET('modelo', $r->modelo);
                $alm->__SET('kilometros', $r->kilometros);
                $result[] = $alm;
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function get_solicitud($id)
    {
        $pdo  = $this->db_connection->pdo;
        try {
            $result = array();
            $stm = $this->$pdo->prepare("SELECT * FROM smart_center_rfp_solicitudes WHERE id = ?");
            $stm->execute(array($id));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $alm = new Solicitud();
                $alm->__SET('id', $r->id);
                $alm->__SET('marca', $r->marca);
                $alm->__SET('modelo', $r->modelo);
                $alm->__SET('kilometros', $r->kilometros);
                $result[] = $alm;
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function create_solicitud(Solicitud $data)
    {
        $presupuesto_controller = new presupuesto_controller();
        $pdo  = $this->db_connection->pdo;
        try {
            $presupuesto = new Presupuesto();
            //todos los atributos de presupuesto, para enviar el objeto al controlador.
            $presupuesto->__SET('id_rfp_centro_de_csoto_presupuesto', $data->id_rfp_centro_de_csoto_presupuesto);
            $presupuesto->__SET('tipo_presupuesto_rfp_presupuesto', $data->tipo_presupuesto_rfp_presupuesto);
            $presupuesto->__SET('monto_rfp_presupuesto', $data->monto_rfp_presupuesto);

            // Crear el presupuesto utilizando el controlador de presupuestos
            $id_presupuesto = $presupuesto_controller->create_presupuesto($presupuesto);


            //se debe crear primero el presupuesto con el controlador de presupuesto
            $sql = "INSERT INTO smart_center_rfp_solicitudes (marca, modelo, kilometros) VALUES (?, ?, ?)";
            $this->$pdo->prepare($sql)->execute(array(
                $data->__GET('marca'),
                $data->__GET('modelo'),
                $data->__GET('kilometros')
            ));
            return $this->$pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // Resto de los métodos
    public function update(Solicitud $data)
    {
        $pdo  = $this->db_connection->pdo;
        try {
            $sql = "UPDATE smart_center_rfp_solicitud SET
            marca = ?,
            modelo = ?,
            kilometros = ?
            WHERE id = ?";
            $this->$pdo->prepare($sql)
                ->execute(
                    array(
                        $data->__GET('marca'),
                        $data->__GET('modelo'),
                        $data->__GET('kilometros'),
                        $data->__GET('id')
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    // eliminar una solicitud con soft delete
    public function delete($id)
    {
        $pdo  = $this->db_connection->pdo;
        try {
            $sql = "UPDATE smart_center_rfp_solicitud SET
        eliminado = 1,
        WHERE id = ?";
            $this->$pdo->prepare($sql)
                ->execute(
                    array(
                        $id
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
