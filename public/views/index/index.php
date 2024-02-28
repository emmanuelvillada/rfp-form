<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario RFP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,
    wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <header class="header">
        <h1>
            HWI logo enterprise roboto
        </h1>
        <div class="buttons">
            <button class="button-mis-solicitudes">Mis Solicitudes</button>
        </div>
    </header>
    <main class="index-container">
        <section>
            <h1>BIENVENIDO A LA APLICACION DE FORMULARIO RFP</h1>
        <p>
            Este formulario esta creado con el proposito de ayudar a la creacion de una solicitud RFP, si desea crear una solicitud <br>
            diligencie el formulario y presione el boton enviar, si desea gestionar sus solicitudes ingrese en el boton mis solicitudes.
        </p>
        <form action="public\controllers\solicitud_controller\SolicitudController.php" method="post">
            <label for="tipo_solicitud" >Elija si su solicitud es puntual o regular
                <input type="radio" name="tipo_solicitud" value="puntual">Puntual
                <input type="radio" name="tipo_solicitud" value="regular" id="">Regular
            </label>

            <label for="producto_servicio">Elija si su solicitud es un suministro o un servicio
                <input type="radio" name="producto_servicio" value="suministro">Sumnistro
                <input type="radio" name="producto_servicio" value="servicio" id="">Servicio
            </label>

            <label for="tipo_presupuesto">
                <input type="radio" name="tipo_presupuesto" value="capex" id="">Capex
                <input type="radio" name="tipo_presupuesto" value="opex" id="">Opex
                <input type="radio" name="tipo_presupuesto" value="sobreejecucion" id="">sobreejecucion
            </label>

            <label id="pregunta1" class="hidden">
            Seq RN: <input type="number" name="seq rn"><br>
</label>

        <div id="pregunta2" class="hidden">
            CECO: <input type="number" name="ceco"><br>
        </div>
            
        </form>
        </section>
        </main>
    <footer> </footer>
</body>
<script src="script.js"></script>
</html>