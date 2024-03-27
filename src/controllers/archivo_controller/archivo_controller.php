<?php
class archivo_controller{

    private $db_connection;

    public function __construct()
    {
        $this->db_connection = new db_connection();
    }

    public function create($id_rfp_solicitud_archivo,$nombre_rfp_archivo,$tipo_rfp_archivo, $ruta_rfp_archivo, $fecha_subida_rfp_archivo){
        $pdo = $this->db_connection->pdo;

        $sql = "INSERT INTO smart_center_rfp_archivos (id_rfp_solicitud_archivo,nombre_rfp_archivo, tipo_rfp_archivo, ruta_rfp_archivo,fecha_subida_rfp_archivo) VALUES ( ?, ?, ?, ?, ?)";
            $pdo->prepare($sql)->execute(array(
                $id_rfp_solicitud_archivo,
                $nombre_rfp_archivo,
                $tipo_rfp_archivo,
                $ruta_rfp_archivo,
                $fecha_subida_rfp_archivo
            ));
    }
    public function get_archivos($id_solicitud_archivo){
        $pdo = $this->db_connection->pdo;
        $sql = "SELECT * FROM smart_center_rfp_archivos WHERE id_rfp_solicitud_archivo = ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($id_solicitud_archivo));
        // Obtener los resultados de la consulta
        $archivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $archivos;
    }
    
}

?>