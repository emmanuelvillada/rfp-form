<?php
class SolicitudController {

    // función para enlistar solicitudes
    public function enlist(){

    }

    // Función para mostrar una solicitud en específico
    public function get($id) {
        
        echo "Mostrar usuario con ID: " . $id;
    }

    public function create() {
        // Función para la creación de una solicitud
        echo "Mostrar formulario de creación de usuario";
    }

    public function store() {
        // Lógica para almacenar un nuevo usuario en la base de datos
        echo "Almacenar un nuevo usuario";
    }

    public function edit($id) {
        // Lógica para mostrar el formulario de edición de usuario
        echo "Mostrar formulario de edición de usuario para el usuario con ID: " . $id;
    }

    public function update($id) {
        // Lógica para actualizar un usuario en la base de datos
        echo "Actualizar usuario con ID: " . $id;
    }

    public function destroy($id) {
        // Lógica para eliminar un usuario de la base de datos
        echo "Eliminar usuario con ID: " . $id;
    }
}

?>