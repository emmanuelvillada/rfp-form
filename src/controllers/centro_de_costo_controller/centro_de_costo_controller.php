<?php
require_once('../../db_conection/db_connection.php');
class centro_de_costo_controller
{
    private $db_connection;
    public function __CONSTRUCT()
    {
        $this->db_connection = new db_connection();
    }

    public function get($id_area) : [] {
        $pdo  = $this->db_connection->pdo;
        try {
            $result = array();
            $stm = $this->$pdo->prepare("SELECT * FROM smart_center_rfp_centro_de_costos WHERE id_rfp_centro_de_costo_area = ?");
            $stm->execute(array($id_area));
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $alm = new Centro_de_costo();
                $alm->__SET('id_rfp_centro_de_costo', $r->id_rfp_centro_de_costo);
                $alm->__SET('id_rfp_centro_de_costo_area', $r->id_rfp_centro_de_costo_area);
                $alm->__SET('nombre_rfp_centro_de_costo', $r->nombre_rfp_centro_de_costo);
                
                $result[] = $alm;
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>