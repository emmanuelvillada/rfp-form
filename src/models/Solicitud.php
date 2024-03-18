<?php
class Solicitud
{
    private $id_rfp_solicitud;
    private $id_rfp_usuario_solicitud;
    private $id_rfp_subcategoria_solicitud;
    private $id__rfp_presupuesto_solicitud;
    private $id_rfp_fase_solicitud;
    private $fecha_creacion_rfp_solicitud;
    private $fecha_revision_rfp_solicitud;
    private $fecha_requerimiento_rfp_solicitud;
    private $fecha_finalizacion_rfp_solictud;
    private $fecha_eliminacion_rfp_solicitud;
    private $tipo_rfp_solicitud;
    private $producto_servicio_rfp_solicitud;
    private $detalle_rfp_solicitud;
    private $descripcion_rfp_solicitud;
    private $necesidad_rfp_solicitud;
    private $comentario_rfp_solicitud;
    private $estado_rfp_solicitud;
    private $eliminado_rfp_solicitud;
    private $riesgo_rfp_solicitud;
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

