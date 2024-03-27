<?php
require_once('../../db_conection/db_connection.php');
class subcategoria_controller
{
    private $db_connection;
    public function __CONSTRUCT()
    {
        $this->db_connection = new db_connection();
    }

    public function get()  {
        $pdo  = $this->db_connection->pdo;
        try {
            $result = array();
            $stm = $pdo->prepare("SELECT * FROM smart_center_rfp_subcategoria;
            ");
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>