<?php
class SolicitudController
{

    // función para enlistar solicitudes
    public function get_solicitudes()
    {
        // Datos de conexión a la base de datos
        $host = 'localhost';
        $dbname = 'rfp';
        $username = 'localhost';
        $password = '1903';

        try {
            // Crear una instancia de la clase PDO para establecer la conexión
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            // Configurar PDO para que lance excepciones en caso de errores
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta SQL para seleccionar todos los datos de la tabla usuarios
            $sql = "SELECT * FROM smart_center_rfp_solicitudes";

            // Preparar la consulta
            $stmt = $pdo->prepare($sql);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener todos los resultados como un array asociativo
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $usuarios;

            // Mostrar los resultados
            foreach ($usuarios as $usuario) {
                echo "ID: " . $usuario['id'] . ", Nombre: " . $usuario['nombre'] . ", Edad: " . $usuario['edad'] . "<br>";
            }
        } catch (PDOException $e) {
            // Manejar errores de conexión
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    // Función para mostrar una solicitud en específico
    public function get($id)
    {
        // Datos de conexión a la base de datos
        $host = 'localhost';
        $dbname = 'rfp';
        $username = 'localhost';
        $password = '1903';

        try {
            // Crear una instancia de la clase PDO para establecer la conexión
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            // Configurar PDO para que lance excepciones en caso de errores
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta SQL para seleccionar todos los datos de la tabla solicitudes
            $sql = "SELECT * FROM smart_center_rfp_solicitudes where id_rfp_usuario = $id";

            // Preparar la consulta
            $stmt = $pdo->prepare($sql);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener todos los resultados como un array asociativo
            $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $solicitudes;

            // Mostrar los resultados
            foreach ($solicitudes as $solicitud) {
                echo "ID: " . $solicitud['id'] . ", Nombre: " . $solicitud['nombre'] . ", Edad: " . $solicitud['edad'] . "<br>";
            }
        } catch (PDOException $e) {
            // Manejar errores de conexión
            echo "Error de conexión: " . $e->getMessage();
        }

        echo "Mostrar usuario con ID: " . $id;
    }

    public function create()
    {
        // Función para la creación de una solicitud
        echo "Mostrar formulario de creación de usuario";
    }

    public function store()
    {
        // Lógica para almacenar un nuevo usuario en la base de datos
        echo "Almacenar un nuevo usuario";
    }

    public function edit($id)
    {
        // Lógica para mostrar el formulario de edición de usuario
        echo "Mostrar formulario de edición de usuario para el usuario con ID: " . $id;
    }

    public function update($id)
    {
        // Lógica para actualizar un usuario en la base de datos
        echo "Actualizar usuario con ID: " . $id;
    }

    public function destroy($id)
    {
        // Lógica para eliminar un usuario de la base de datos
        echo "Eliminar usuario con ID: " . $id;
    }
}
