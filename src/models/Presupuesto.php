<?php
 class Presupuesto 
{
    private $id_rfp_presupuesto;
    private $tipo_presupuesto_rfp_presupuesto;
    private $ceco_rfp_presupuesto;
    private $seq_rn_rfp_presupuesto;
    //fuunciones para retornar y cambiar atributos
    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; } 
}
