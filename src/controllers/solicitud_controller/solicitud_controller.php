<?php
require_once('presupuestos_controller.php');
require_once('Solicitud.php');
require_once('Presupuesto.php');

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
             $presupuesto = new Presupuesto();
                //todos los atributos de presupuesto, para enviar el objeto al controlador.
             $presupuesto->__SET('id_rfp_centro_de_csoto_presupuesto', $data->id_rfp_centro_de_csoto_presupuesto);
             $presupuesto->__SET('tipo_presupuesto_rfp_presupuesto', $data->tipo_presupuesto_rfp_presupuesto);
             $presupuesto->__SET('monto_rfp_presupuesto', $data->monto_rfp_presupuesto);   
            $presupuesto_controller = new PresupuestoController();

            // Crear el presupuesto utilizando el controlador de presupuestos
            $id_presupuesto = $presupuesto_controller->crear_presupuesto($presupuesto);

            
            //se debe crear primero el presupuesto con el controlador de presupuesto
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
    public function update(Solicitud $data)
    {
        try
            {
            $sql = "UPDATE smart_center_rfp_solicitud SET
            marca = ?,
            modelo = ?,
            kilometros = ?
            WHERE id = ?";
            $this->pdo->prepare($sql)
            ->execute(
            array(
            $data->__GET('marca'),
            $data->__GET('modelo'),
            $data->__GET('kilometros'),
            $data->__GET('id')
            )
            );
            } catch (Exception $e)
            {
            die($e->getMessage());
            }

    }

    // eliminar una solicitud con soft delete
    public function delete($id)
    {
        
        try
        {
        $sql = "UPDATE smart_center_rfp_solicitud SET
        eliminado = 1,
        WHERE id = ?";
        $this->pdo->prepare($sql)
        ->execute(
        array(
        $id
        )
        );
        } catch (Exception $e)
        {
        die($e->getMessage());
        }
        
    }

}

?>
