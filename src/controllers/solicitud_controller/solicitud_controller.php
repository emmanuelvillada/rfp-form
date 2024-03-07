<?php

class solicitud_controller
{
    public function __construct()
    {
        try
        {
            $this->pdo = new PDO('mysql:host=localhost;dbname=rfp', 'root', '1903');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function handle_request()
    {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'listar_solicitudes':
                    return $this->get_solicitudes();
                    break;
                case 'ver_solicitud':
                    if (isset($_POST['id'])) {
                        return $this->get_solicitud($_POST['id']);
                    }
                    break;
                case 'crear_solicitud':
                    if (isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['kilometros'])) {
                        $solicitud = new Solicitud();
                        $solicitud->__SET('marca', $_POST['marca']);
                        $solicitud->__SET('modelo', $_POST['modelo']);
                        $solicitud->__SET('kilometros', $_POST['kilometros']);
                        return $this->create_solicitud($solicitud);
                    }
                    break;
                case 'actualizar_solicitud':
                    // Aquí iría el código para actualizar una solicitud
                    break;
                case 'eliminar_solicitud':
                    // Aquí iría el código para eliminar una solicitud
                    break;
                default:
                    return "Acción no válida";
                    break;
            }
        }
        return "No se especificó ninguna acción";
    }

    public function get_solicitudes()
    {
        try
        {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM smart_center_rfp_solicitudes");
            $stm->execute();
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Solicitud();
                $alm->__SET('id', $r->id);
                $alm->__SET('marca', $r->marca);
                $alm->__SET('modelo', $r->modelo);
                $alm->__SET('kilometros', $r->kilometros);
                $result[] = $alm;
            }
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function get_solicitud($id)
    {
        try
        {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM smart_center_rfp_solicitudes WHERE id = ?");
            $stm->execute(array($id));
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $alm = new Solicitud();
                $alm->__SET('id', $r->id);
                $alm->__SET('marca', $r->marca);
                $alm->__SET('modelo', $r->modelo);
                $alm->__SET('kilometros', $r->kilometros);
                $result[] = $alm;
            }
            return $result;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }

    public function create_solicitud(Solicitud $data)
    {
        try
        {
            $sql = "INSERT INTO smart_center_rfp_solicitudes (marca, modelo, kilometros) VALUES (?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array(
                $data->__GET('marca'),
                $data->__GET('modelo'),
                $data->__GET('kilometros')
            ));
            return "Solicitud creada correctamente";
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }

    // Resto de los métodos

}

?>
