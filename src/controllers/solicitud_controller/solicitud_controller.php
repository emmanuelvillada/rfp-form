<?php
include_once('../../db_conection/db_connection.php');
include_once('../../controllers/presupuesto_controller/presupuesto_controller.php');
include_once('../../controllers/archivo_controller/archivo_controller.php');
include_once('../../models/Solicitud.php');
include_once('../../models/Presupuesto.php');
include_once('../../models/Archivo.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);  



class solicitud_controller
{
    private $db_connection;
    
    public function __construct()
    {
        $this->db_connection = new db_connection();
    }

    

    public function get_solicitudes()
    {
        $pdo  = $this->db_connection->pdo;
        try {
            $stm = $pdo->prepare("SELECT
            s.id_rfp_solicitud,
            u.Nombre AS nombre_usuario,
            u.Apellido AS apellido_usuario,
            sc.nombre_rfp_subcategoria AS nombre_subcategoria,
            p.id_rfp_presupuestos,
            p.tipo_presupuesto_rfp_presupuesto,
            p.monto_rfp_presupuesto,
            cc.ceco_rfp_centro_de_costo,
            f.nombre_rfp_fase,
            s.fecha_creacion_rfp_solicitud,
            s.tipo_rfp_solicitud,
            s.producto_servicio_rfp_solicitud,
            s.detalle_rfp_solicitud,
            s.descripcion_rfp_solicitud,
            s.estado_rfp_solicitud,
            s.riesgo_rfp_solicitud
        FROM
            smart_center_rfp_solicitudes s
        LEFT JOIN
            usuarios u ON s.id_rfp_usuario_solicitud = u.documento
        LEFT JOIN
            smart_center_rfp_subcategoria sc ON s.id_rfp_subcategoria_solicitud = sc.id_smart_cente_rfpr_subcategoria
        LEFT JOIN
            smart_center_rfp_presupuestos p ON s.id_rfp_presupuesto_solicitud = p.id_rfp_presupuestos
        LEFT JOIN
            smart_center_rfp_centro_de_costos cc ON p.id_rfp_centro_de_costo_presupuesto = cc.id_rfp_centro_de_costo
        LEFT JOIN
            smart_center_rfp_fases f ON s.id_rfp_fase_solicitud = f.id_rfp_fase;
        ");
            $stm->execute();
            $solicitudes = $stm->fetchAll(PDO::FETCH_ASSOC);
            return $solicitudes;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function get_solicitud($id_rfp_solicitud)
    {
        $pdo  = $this->db_connection->pdo;
        try {
            $result = array();
            $stm = $this->$pdo->prepare("SELECT * FROM smart_center_rfp_solicitudes WHERE id_rfp_solicitud = ?");
            $stm->execute(array($id_rfp_solicitud));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $alm = new Solicitud();
                $alm->__SET('id_rfp_usuario_solicitud', $r->id_rfp_usuario_solicitud);
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

    public function create_solicitud(Solicitud $data, presupuesto_controller $presupuesto_controller)
    {
        echo 'controlador, funcion create';
        $pdo  = $this->db_connection->pdo;
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
                $data->__GET('riesgo_rfp_solicitud')
            ));
            var_dump($data);
            return $pdo->lastInsertId();
            
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
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
        eliminado = 1
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
?>

