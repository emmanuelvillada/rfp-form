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
            $stm = $pdo->prepare("SELECT 
            scs.id_rfp_subcategoria,
            scs.nombre_rfp_subcategoria,
            scs.id_rfp_categoria_subcategoria,
            scc.nombre_rfp_categoria AS nombre_categoria,
            scs.id_rfp_usuario_subcategoria,
            u.Nombre AS nombre_usuario_subcategoria
        FROM 
            smart_center_rfp_subcategoria scs
        JOIN 
            smart_center_rfp_categoria scc ON scs.id_rfp_categoria_subcategoria = scc.id_rfp_categoria
        JOIN 
            usuarios u ON scs.id_rfp_usuario_subcategoria = u.documento;
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