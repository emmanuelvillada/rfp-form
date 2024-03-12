<?php
require_once('../../db_conection/db_connection.php');
class presupuesto_controller
{
    private $db_connection;
    public function __CONSTRUCT()
    {
        $this->db_connection = new db_connection();
    }

    public function create_presupuesto(Presupuesto $presupuesto)
    {
        $pdo = $this->db_connection->pdo;
        try {
            $sql = "INSERT INTO smart_center_rfp_presupuestos (tipo_presupuesto_rfp_presupuesto,ceco_rfp_presupuesto,seq_rn_rfp_presupuesto, monto_rfp_presupuesto)
        VALUES ( ?, ?,?)";
            $this->$pdo->prepare($sql)
                ->execute(
                    array(
                        $presupuesto->__GET('tipo_presupuesto'),
                        $presupuesto->__GET('ceco_rfp_presupuesto'),
                        $presupuesto->__GET('seq_rn_rfp_presupuesto'),
                        $presupuesto->__GET('monto_rfp_presupuesto')
                    )
                );
            return $this->$pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
