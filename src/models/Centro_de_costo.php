<?php
class Centro_de_costo{
    private $id_rfp_centro_de_costo;
    private $id_rfp_centro_de_costo_area;
    private $nombre_rfp_centro_de_costo;
    
    //fuunciones para retornar y cambiar atributos
    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}
?>