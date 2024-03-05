<?php
class Solicitud
{
 private $id;
 private $marca;
 private $modelo;
 private $kilometros;
 public function __GET($k){ return $this->$k; }
 public function __SET($k, $v){ return $this->$k = $v; }
}
?>