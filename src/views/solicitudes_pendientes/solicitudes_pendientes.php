<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes Pendientes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital
,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,
900&display=swap"
      rel="stylesheet"
    />
</head>
<body>
    <h1><b>SOLICITUDES PENDIENTES</b></h1>
    <p>Para aceptar una solicitud, seleccione el boton aceptar e ingrese una categoria y subcategoria <br>
         para la solicitud.
         Si desea rechazar una solicitud, <br>
          seleccione el boton rechazar e ingrese un mensaje explicando el motivo de su rechazo.
        <br></p>

        <!-- separador titulo y cuerpo -->
    <main>
        <!-- llevar en un archivo a parte la consulta de las solicitudes <br>
         desde la base de datos solo invocar y enviar parametros en cada una de las paginas -->

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
        <table class="solicitudes_pendientes_table">
            <thead>
            <tr>
                <th>Id solicitud</th>
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
                <?php
                <!-- aqui invocar la funcion y despues crear el tr con td -->
                foreach ($array as &$valor) {
                    $valor = $valor * 2;
                
                <tr>
                    <td>
                        
                    </td>
                </tr>
            }
                ?>
                
            </tbody>
            
        </table>
        <div class="hide">
            <form action="" method="post">
                <label for="categoria">
                    <select name="categoria" id="categoria" >
                        <option value="industrial">Industrial</option>
                        <option value="supply-chain">Supply chain</option>
                        <option value="sg&a">SG&A</option>
                </select>
            </label>
            <label for="subcategoria">
                <select name="subcategoria" id="subcategoria">
                    <option value=""></option>
                </select>
            </label>
            </form>
        </div>
    </main>
</body>
<script>
    
    // script para crear las tablas estudiar como concatenar la informacion de la base de datos
    function generar_tabla() {
  // Obtener la referencia del elemento body
  var body = document.getElementsByTagName("body")[0];

  // Crea un elemento <table> y un elemento <tbody>
  var tabla = document.createElement("table");
  var tblBody = document.createElement("tbody");

  // Crea las celdas
  for (var i = 0; i < 2; i++) {
    // Crea las hileras de la tabla
    var hilera = document.createElement("tr");

    for (var j = 0; j < 2; j++) {
      // Crea un elemento <td> y un nodo de texto, haz que el nodo de
      // texto sea el contenido de <td>, ubica el elemento <td> al final
      // de la hilera de la tabla
      var celda = document.createElement("td");
      var textoCelda = document.createTextNode(
        "celda en la hilera " + i + ", columna " + j,
      );
      celda.appendChild(textoCelda);
      hilera.appendChild(celda);
    }

    // agrega la hilera al final de la tabla (al final del elemento tblbody)
    tblBody.appendChild(hilera);
  }

  // posiciona el <tbody> debajo del elemento <table>
  tabla.appendChild(tblBody);
  // appends <table> into <body>
  body.appendChild(tabla);
  // modifica el atributo "border" de la tabla y lo fija a "2";
  tabla.setAttribute("border", "2");
}

</script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#UserTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                "aLengthMenu": [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "Todos"]
                ]
            });
        });
    </script>

</html>