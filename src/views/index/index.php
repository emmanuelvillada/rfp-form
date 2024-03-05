<?php
session_start();

// Verificar si las credenciales de sesión existen, queda pendiente revisar el area para saber si es administrador o usuario
if (isset($_SESSION['usuario']) && isset($_SESSION['contraseña'])) {
    $usuario = $_SESSION['usuario'];
    $contraseña = $_SESSION['contraseña'];


    echo "Usuario: $usuario <br>";
    echo "Contraseña: $contraseña";
} else {
    echo "Las credenciales de sesión no existen.";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario RFP</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <img class="logo-hwi" src="../../../public\images\Logo HWI .png" alt="Logo HWI">
        <div class="buttons">
            <a href="../mis_solicitudes/mis_solicitudes.php"><button class="button-mis-solicitudes">Mis Solicitudes</button></a>
            <a href="../actualizar_solicitud/actualizar_solicitud.php"><button class="button-mis-solicitudes">Actualizar Solicitud</button></a>
        </div>
    </header>

    <main class="index-container">

        <section class="section">
            <div class="h2-container">
                <h2>FORMULARIO RFP</h2>
            </div>
            <form action="public\controllers\solicitud_controller\SolicitudController.php" method="post">

                <div>

                    <label for="tipo_solicitud">1. Elija si su solicitud es puntual o regular:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <div class="radio-buttons">
                        <input type="radio" name="tipo_solicitud" value="puntual" id="puntualRadio">
                        <label for="puntualRadio">Puntual</label>
                        <input type="radio" name="tipo_solicitud" value="regular" id="regularRadio">
                        <label for="regularRadio">Regular</label>
                    </div>
                </div>

                <div>
                    <label for="producto_servicio">2. Elija si su solicitud es un suministro o un servicio:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <div class="radio-buttons">
                        <input type="radio" name="producto_servicio" value="suministro" id="suministroRadio">
                        <label for="suministroRadio">Suministro</label>
                        <input type="radio" name="producto_servicio" value="servicio" id="servicioRadio">
                        <label for="servicioRadio">Servicio</label>
                    </div>
                </div>


                <div>
                    <label for="tipo_presupuesto">3. Elija su tipo de presupuesto:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <div class="radio-buttons">
                        <input type="radio" name="tipo_presupuesto" value="capex" id="capexRadio" checked>
                        <label for="capexRadio">Capex</label>
                        <input type="radio" name="tipo_presupuesto" value="opex" id="opexRadio">
                        <label for="opexRadio">Opex</label>
                        <input type="radio" name="tipo_presupuesto" value="sobreejecucion" id="sobreejecucionRadio">
                        <label for="sobreejecucionRadio">Sobreejecución</label>
                    </div>



                    <div id="seq_rn" class="hidden">
                        <label for="seq_rn"> Digite su Seq_rn:</label>
                        <input type="number" name="seq_rn">
                    </div>

                    <div id="ceco" class="hidden">
                        <label for="ceco"> Digite su CECO:</label>
                        <input type="number" name="ceco">
                    </div>

                </div>

                <div>
                    <label for="detalle_solicitud">4. Detalle el producto y/o servicio que requiere:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="text" name="detalle_solicitud" id="detalle_solicitud">
                </div>

                <div>
                    <label for="descripcion_solicitud">5. Describa minuciosamente el producto y/o servicio que requiere:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="text" name="descripcion_solicitud" id="descripcion_solicitud">
                </div>

                <div>
                    <label for="requerimiento_solicitud">6. Informe para qué se requiere el producto y/o servicio que requiere:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="text" name="requerimiento_solicitud" id="requerimiento_solicitud">
                </div>

                <div>
                    <label for="fecha_requerimiento">7. Indique la fecha para la cual requiere su producto y/o servicio,
                        la fecha debe ser mayor a 8 días desde la fecha actual:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="date" name="fecha_requerimiento" id="fecha_requerimiento">
                </div>

                <div>
                    <label for="archivos">8. Adjunte los archivos que considere necesarios para su solicitud:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="file" name="archivos" id="archivos" multiple>
                </div>

                <div>
                    <label for="comentario">9. Comentarios:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="text" name="comentario" id="comentario">
                </div>

                <input class="boton-submit" type="submit" value="Crear Solicitud">
            </form>
        </section>
    </main>

    <footer> </footer>
</body>

<script src="../index/index_script.js">
</script>

</html>