<?php
require_once('../../db_conection/db_connection.php');
class presupuesto_controller
{
    private $db_connection;
    public function __construct()
    {
        $this->db_connection = new db_connection();
    }

    public function create_presupuesto(Presupuesto $presupuesto)
    {
        $pdo = $this->db_connection->pdo;
        try {
            $sql = "INSERT INTO smart_center_rfp_presupuestos (tipo_presupuesto_rfp_presupuesto, id_rfp_centro_de_costo_presupuesto, seq_rn_rfp_presupuesto, monto_rfp_presupuesto)
            VALUES (:tipo_presupuesto_rfp_presupuesto, :id_rfp_centro_de_costo_presupuesto, :seq_rn_rfp_presupuesto, :monto_rfp_presupuesto)";
            $stmt = $pdo->prepare($sql);

            // Obtener los valores de los atributos del objeto Presupuesto
            $tipo_presupuesto_rfp_presupuesto = $presupuesto->__GET('tipo_presupuesto_rfp_presupuesto');
            $id_rfp_centro_de_costo_presupuesto = $presupuesto->__GET('id_rfp_centro_de_costo_presupuesto');
            $seq_rn_rfp_presupuesto = $presupuesto->__GET('seq_rn_rfp_presupuesto');
            $monto_rfp_presupuesto = $presupuesto->__GET('monto_rfp_presupuesto');

            // Vincular los parámetros
            $stmt->bindParam(':tipo_presupuesto_rfp_presupuesto', $tipo_presupuesto_rfp_presupuesto);
            $stmt->bindParam(':id_rfp_centro_de_costo_presupuesto', $id_rfp_centro_de_costo_presupuesto);
            $stmt->bindParam(':seq_rn_rfp_presupuesto', $seq_rn_rfp_presupuesto);
            $stmt->bindParam(':monto_rfp_presupuesto', $monto_rfp_presupuesto);

            // Ejecutar la consulta
            $stmt->execute();

            return $pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
