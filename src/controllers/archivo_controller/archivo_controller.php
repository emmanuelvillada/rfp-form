<?php
class archivo_controller{
    
    private $db_connection;

    public function __construct()
    {
        $this->db_connection = new db_connection();
    }

}

?>