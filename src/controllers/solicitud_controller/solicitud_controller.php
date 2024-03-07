<?php
class solicitud_controller
{
        public function __construct()
    {
    try
    {
    $this->pdo = new PDO('mysql:host=localhost;dbname=rfp', 'root',
    '1903');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e)
    {
    die($e->getMessage());
    }
    }



    // función para enlistar todas las solicitudes solicitudes
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

    // Función para mostrar las solicitudes de un usuario solicitud en específico
    public function get_solicitud($id)
    {
        try
            {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM smart_center_rfp_solicitudes WHERE id_usuario_solicitud = ?");
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

    // crear una solicitud
    public function create_solicitud(Solicitud $data)
    {
        include '../presupuestos_contrller.php';
        try
            {
                // creando el presupuesto de la solicitud con el controlador presupuesto
                $presupuesto = new Presupuesto;
                $presupuesto->__SET('tipo_presupuesto_rfp_presupuesto', $tipo_presupuesto = $_POST['tipo_presupuesto'])
                $txtfecha_creacion_rfp_creacion = getdate();

                $id__rfp_presupuesto_solicitud =  
 
                $txtEmail = $_POST['txtEmail'];
 
                $txtMessage = $_POST['txtMessage'];
            $sql = "INSERT INTO smart_center_rfp_solicitudes (id..,modelo,kilometros)
            VALUES (?, ?, ?)";
            $this->pdo->prepare($sql)
            ->execute(
            array(
            $data->__GET('marca'),
            $data->__GET('modelo'),
            $data->__GET('kilometros')
            )
            );
            } catch (Exception $e)
            {
            die($e->getMessage());
            }

        echo "Mostrar formulario de creación de usuario";
    }



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
