<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modificar fase</title>
</head>
<body>
    <h1><b>SOLICITUDES PENDIENTES</b></h1>
    <main><?php 
        $username = "username"; 
        $password = "password"; 
        $database = "your_database"; 
        $mysqli = new mysqli("localhost", $username, $password, $database); 
        $query = "SELECT * FROM table_name";
        
        
        echo '<table border="0" cellspacing="2" cellpadding="2"> 
              <tr> 
                  <td> Value1 </td> 
                  <td> Value2 </td> 
                  <td> Value3 </td> 
                  <td> Value4 </td> 
                  <td> Value5 </td> 
              </tr>';
        
        if ($result = $mysqli->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $field1name = $row["col1"];
                $field2name = $row["col2"];
                $field3name = $row["col3"];
                $field4name = $row["col4"];
                $field5name = $row["col5"]; 
        
                echo '<tr> 
                          <td>'.$field1name.'</td> 
                          <td>'.$field2name.'</td> 
                          <td>'.$field3name.'</td> 
                          <td>'.$field4name.'</td> 
                          <td>'.$field5name.'</td> 
                      </tr>';
            }
            $result->free();
        } 
        ?>
        <!-- opciones para crear la tabla con los datos desde la base de datos -->
        <table>
            <thead>
            <tr>
                <th>Id solicitud</th>
                <th>fase</th>
                <th>Fecha creacion</th>
                <th>Fecha de requerimiento </th>
                <th>Tipo </th>
                <th>Producto o servicio</th>
                <th>Detalle</th>
                <th>Descripcion</th>
                <th>Necesidad</th>
                <th>Comentario</th>
                
            </tr>
        </thead>
        <tbody>

        </tbody>
        </table>
</body>
</html>