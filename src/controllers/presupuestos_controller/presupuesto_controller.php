<?php
class presupuestosc_ontroller
{
        public function __CONSTRUCT()
    {
    try
    {
    $this->pdo = new PDO('mysql:host=localhost;dbname=rfp', 'root',
    '1903');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e)
    {
    die($e->getMessage());
    }
    }

    public function create_presupuesto(Presupuesto $presupuesto){
        try
        {
          

        $sql = "INSERT INTO smart_center_rfp_presupuestos (tipo_presupuesto_rfp_presupuesto,ceco_rfp_presupuesto,seq_rn_rfp_presupuesto)
        VALUES ( ?, ?,?)";
        $this->pdo->prepare($sql)
        ->execute(
        array(
            $presupuesto->__GET('tipo_presupuesto'),
            $presupuesto->__GET('ceco_rfp_presupuesto'),
            $presupuesto->__GET('seq_rn_presupuestos')
        )
        );
        return $this->pdo->lastInsertId();
        } catch (Exception $e)
        {
        die($e->getMessage());
        }

    }
}
?>