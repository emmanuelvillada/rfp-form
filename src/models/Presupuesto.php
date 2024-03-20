<?php
class Presupuesto 
{
    private $id_rfp_presupuesto;
    private $tipo_presupuesto_rfp_presupuesto;
    private $monto_rfp_presupuesto;
    private $id_rfp_centro_de_costo_presupuesto;
    private $seq_rn_rfp_presupuesto;
    //fuunciones para retornar y cambiar atributos
    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; } 
    
}
