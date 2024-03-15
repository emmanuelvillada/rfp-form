<?php
require_once('../../db_conection/db_connection.php');
class centro_de_costo_controller
{
    private $db_connection;
    public function __CONSTRUCT()
    {
        $this->db_connection = new db_connection();
    }

    public function get($documento)  {
        $pdo  = $this->db_connection->pdo;
        try {
            $result = array();
            $stm = $pdo->prepare("SELECT cc.*
            FROM usuarios u
            JOIN areas a ON u.id_area = a.id
            JOIN smart_center_rfp_direcciones d ON a.id_rfp_direccion = d.id_rfp_direccion
            JOIN smart_center_rfp_centro_de_costos cc ON d.id_rfp_direccion = cc.id_rfp_direccion_centro_de_costo
            WHERE u.documento = ?;
            ");
            $stm->execute(array($documento));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $alm = new Centro_de_costo();
                $alm->__SET('id_rfp_centro_de_costo', $r->id_rfp_centro_de_costo);
                $alm->__SET('ceco_rfp_centro_de_costo', $r->ceco_rfp_centro_de_costo);
                $alm->__SET('nombre_rfp_centro_de_costo', $r->nombre_rfp_centro_de_costo);
                $alm->__SET('id_rfp_direccion_centro_de_costo', $r->id_rfp_direccion_centro_de_costo);
                
                
                $result[] = $alm;
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>