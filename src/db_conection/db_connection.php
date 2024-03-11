<?php
class db_connection {
    private $db_host = 'localhost';
    private $db_name = 'rfp';
    private $db_user = 'root';
    private $db_password = '1903';
    public  $pdo;

    public function __construct(){
        try {
            // Usar comillas dobles para que las variables se expandan
            $this->pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
?>
