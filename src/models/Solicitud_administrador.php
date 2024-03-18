<?php
class Solicitud_administrador
{
    private $id_rfp_solicitud;
    private $nombre_usuario;
    private $apellido_usuario;
    private $nombre_categoria;
    //fuunciones para retornar y cambiar atributos
    public function __GET($k)
    {
        return $this->$k;
    }
    public function __SET($k, $v)
    {
        return $this->$k = $v;
    }
    
}
