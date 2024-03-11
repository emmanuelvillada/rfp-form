<?php
class archivo_controller{

    private $db_connection;

    public function __construct()
    {
        $this->db_connection = new db_connection();
    }

    public function create($id_solicitud,$nombre_rfp_archivo,$tipo_rfp_archivo, $ruta_rfp_archivo, $fecha_subida_rfp_archivo){
        $pdo = $this->db_connection->pdo;

        $sql = "INSERT INTO smart_center_rfp_archivos (nombre_rfp_archivo, tipo_rfp_archivo, ruta_rfp_archivo,fecha_subida_rfp_archivo) VALUES (?, ?, ?, ?)";
            $this->$pdo->prepare($sql)->execute(array(
                $nombre_rfp_archivo,
                $tipo_rfp_archivo,
                $ruta_rfp_archivo,
                $fecha_subida_rfp_archivo
            ));
    }
}

?>