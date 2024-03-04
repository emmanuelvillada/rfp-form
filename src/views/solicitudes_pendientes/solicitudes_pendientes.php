<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes Pendientes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet"
    />
</head>
<body>
<header class="header">
        <img class="logo-hwi" src="../../../public/images/Logo HWI .png" alt="">
        <div class="buttons">
            <a href="../administrador/administrador.php"><button class="button-volver">Volver al iniciio</button></a>
        </div>
    </header>
    <main class="container-main">
    <h1>SOLICITUDES PENDIENTES</h1>
        <?php 

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
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                    <td>
                        1
                    </td>
                    <td>
                        02/02/2024
                    </td>
                    <td>
                        15/02/2024
                    </td>
                    <td>
                        Puntual
                    </td>
                    <td>
                        Producto
                    </td>
                    <td>
                        varilla de metal para sostener caja
                    </td>
                    <td>
                        Una varilla de 20x5 cm de metal
                    </td>
                    <td>
                        Se necesita para el area de mantenimiento
                    </td>
                    <td>
                        Se precisa notificar al area de sst
                    </td>
                    <td>
                        <button class="button-categorizar"type="button">Categorizar</button>
                    </td>
                </tr>
                <?php
                
            
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