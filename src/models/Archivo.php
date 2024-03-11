<?php
class Archivo{
    private $id_rfp_archivo;
    private $id_rfp_solicitud_archivo;
    private $nombre_rfp_archivo;
    private $tipo_rfp_archivo;
    private $ruta_rfp_archivo;
    private $fecha_subida_rfp_archivo;
    //fuunciones para retornar y cambiar atributos
    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}
?>