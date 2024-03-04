<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modificar fase</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet"
    />
</head>
<header class="header">
        <img class="logo-hwi" src="../../../public/images/Logo HWI .png" alt="">
        <div class="buttons">
            <a href="../administrador/administrador.php"><button class="button-volver">Volver al iniciio</button></a>
        </div>
    </header>
<body>
    <h1>SOLICITUDES ACEPTADAS</h1>
    <main class="container">
        <?php 
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