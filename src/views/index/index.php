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

                <div class="div1">

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

                <div class="div2">
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


                <div class="div3">
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
                        <label for="seq_rn"> Digite su RN:</label>
                        <br>
                        <input type="number" name="seq_rn">
                        <br>
                        <label for="monto_presupuesto">Digite el monto de su presupuesto :</label>
                        <input type="number" name="monto_presupuesto" id="monto_presupuesto">
                    </div>

                    <div id="ceco" class="hidden">
                        <label for="ceco"> Seleccione su CeCo:</label>
                        <br>        
                        <select name="ceco-select" id="ceco-select">
                            <option value="ceco1">CeCo1</option>
                        </select>
                        <br>
                        <label for="monto_presupuesto">Digite el monto de su presupuesto :</label>
                        <input type="number" name="monto_presupuesto" id="monto_presupuesto">
                    </div>

                </div>

                <div class="div4">
                    <label for="detalle_solicitud">4. ¿Que?:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input placeholder="" type="text" name="detalle_solicitud" id="detalle_solicitud">
                </div>

                <div class="div5">
                    <label for="requerimiento_solicitud">5. ¿Para que?
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="text" name="requerimiento_solicitud" id="requerimiento_solicitud">
                    </div>

                <div class="div6">
                    <label for="descripcion_solicitud">6. ¿Como?
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="text" name="descripcion_solicitud" id="descripcion_solicitud">
                </div>

                <div class="div7">
                    <label for="fecha_requerimiento">7. Indique la fecha para la cual requiere su producto y/o servicio:
                        <br>
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="date" name="fecha_requerimiento" id="fecha_requerimiento">
                </div>

                <div class="div8">
                    <label for="archivos">8. Adjunte los archivos que considere necesarios para su solicitud:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="file" name="archivos" id="archivos" multiple>
                </div>

                <div class="div9">
                    <label for="comentario">9. Comentarios:
                        <span class="tooltip">Solicitud puntual se trata de una unica compra en el tiempo. <br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <input type="text" name="comentario" id="comentario">
                </div>

                <div class="div10"><input class="button-submit" type="submit" value="Crear Solicitud"></div>
            </form>
        </section>
    </main>

    <footer> </footer>
</body>

<script src="../index/index_script.js">
</script>

</html>