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
            <a href="../mis_solicitudes/mis_solicitudes.php"><button class="button-mis-solicitudes">
                    Mis Solicitudes</button></a>
            <a href="../actualizar_solicitud/actualizar_solicitud.php"><button class="button-mis-solicitudes">
                    Actualizar Solicitud</button></a>
        </div>
    </header>

    <main class="index-container">

        <section class="section">
            <div class="h2-container">
                <h2>FORMULARIO RFP</h2>
            </div>
            <form action="public\controllers\solicitud_controller\SolicitudController.php" method="post" id="form">
                <input type="hidden" name="action" value="crear_solicitud">
                <input type="hidden" name="id_rfp_usuario_solicitud" value="<?php $documento = (isset($_SESSION['documento'])) ? $_SESSION['documento'] : '0000000'; echo $documento; ?>">
                <div class="div1">

                    <label for="tipo_rfp_solicitud ">1. Elija si su solicitud es puntual o regular:
                        <span class="tooltip">Solicitud puntual se trata de una compra única en el tiempo.<br>
                            Regular es una compra que se repetira varias veces a través del tiempo.
                        </span>
                    </label>
                    <div class="radio-buttons">
                        <input type="radio" name="tipo_rfp_solicitud " value="puntual" id="puntualRadio" checked>
                        <label for="puntualRadio">Puntual</label>
                        <input type="radio" name="tipo_rfp_solicitud " value="regular" id="regularRadio">
                        <label for="regularRadio">Regular</label>
                    </div>
                </div>

                <div class="div2">
                    <label for="producto_servicio_rfp_solicitud">2. Elija si su solicitud es un suministro o un servicio:
                        <span class="tooltip">El suministro es un bien. En cambio, el servicio se trata de la prestación de una actividad para un objetivo.
                        </span>
                    </label>    
                    <div class="radio-buttons">
                        <input  type="radio" name="producto_servicio_rfp_solicitud" value="suministro" id="suministroRadio" onChange="cambiarMensaje()" checked>
                        <label for="suministroRadio">Suministro</label>
                        <input  type="radio" name="producto_servicio_rfp_solicitud" value="servicio" onChange="cambiarMensaje()" id="servicioRadio">
                        <label for="servicioRadio">Servicio</label>
                    </div>
                </div>


                <div class="div3">
                    <label for="tipo_presupuesto_rfp_presupuesto">3. Elija su tipo de presupuesto:
                        <span class="tooltip">Capex: presupuesto para adquirir o mejorar activos. <br>
                            Opex: presupuesto para gastos operativos. <br>
                            Sobreejecución: Cuando no se tiene presupuesto planificado.
                        </span>
                    </label>
                    <div class="radio-buttons">
                        <input type="radio" name="tipo_presupuesto_rfp_presupuesto" value="capex" id="capexRadio" checked>
                        <label for="capexRadio">Capex</label>
                        <input type="radio" name="tipo_presupuesto_rfp_presupuesto" value="opex" id="opexRadio">
                        <label for="opexRadio">Opex</label>
                        <input type="radio" name="tipo_presupuesto_rfp_presupuesto" value="sobreejecucion" id="sobreejecucionRadio">
                        <label for="sobreejecucionRadio">Sobreejecución</label>
                    </div>



                    <div id="seq_rn" class="hidden">
                        <label for="seq_rn_rfp_presupuesto"> Digite su RN:</label>
                        <br>
                        <input type="number" value = 0 name="seq_rn_rfp_presupuesto">
                        <br>
                        <label for="monto_rfp_presupuesto">Digite el monto de su presupuesto :</label>
                        <input type="number" step="0.01" placeholder="0.00" min="0" name="monto_rfp_presupuesto_seq" id="monto_rfp_presupuesto_seq">
                    </div>

                    <div id="ceco" class="hidden">
                        <label for="id_ rfp_centro_de_costo_presupuesto"> Seleccione su CeCo:</label>
                        <br>
                        <!-- cada opcion del select lleva el id del ceco, asi lo capturamos y se entrega al controlador. -->
                        <select name="id_rfp_centro_de_costo_presupuesto" id="ceco-select">
                            <?php
                            if (isset($_SESSION['id_area'])) {
                                $id_area = $_SESSION['id_area'];
                                $cecos = new centro_de_costo_controller();
                                $cecos->get($id_area);
                                foreach ($cecos as $ceco) {
                                    echo '<option value="' . $ceco->id_rfp_centro_de_costo . '">' . $ceco->nombre_rfp_centro_de_costo . '</option>';
                                }
                            }
                            ?>
                            
                            
                        </select>
                        <br>
                        <label for="monto_rfp_presupuesto">Digite el monto de su presupuesto :</label>
                        <input type="number" step="0.01" placeholder="0.00" min="0" name="monto_rfp_presupuesto_ceco"  id="monto_rfp_presupuesto_ceco">
                    </div>

                </div>

                <div class="div4">
                    <label for="detalle_rfp_solicitud">4. ¿Que se requiere?: <br>
                    </label>
                    <span  id="ejemplo_span1"> ejemplo_suministro
                    </span>
                    <span  id="ejemplo_span2"> ejemplo_servicio
                    </span>
                    
                    <input required placeholder="Describa brevemente que producto y/o servicio requiere." type="text" name="detalle_rfp_solicitud" id="detalle_solicitud">
                </div>

                <div class="div5">
                    <label for="descripcion_rfp_solicitud">5. Especificaciones tecnicas del suministro y/o servicio. <br>
                    </label>                   
                    <span  id="ejemplo_span1.1"> ejemplo_suministro
                    </span>
                    <span  id="ejemplo_span2.1"> ejemplo_servicio
                    </span>
                    
                    <input required placeholder="(altura, grosor, color, material, forma, etc.)." type="text" name="descripcion_rfp_solicitud" id="descripcion_rfp_solicitud">
                </div>

                <div class="div6">
                    <label for="fecha_requerimiento_rfp_solicitud">6. Indique la fecha para la cual requiere su suministro o servicio:
                        <br>
                        <span class="tooltip">En el flujo básico de negociación el tiempo mínimo es de 8 días.
                        </span>
                    </label>
                    <input required type="date" name="fecha_requerimiento_rfp_solicitud" id="fecha_requerimiento">
                </div>

                <div class="div7">
                    <label for="archivos">7. Adjunte los archivos que considere necesarios para su solicitud:
                        <span class="tooltip">Pueden ser cotizaciones, planos, simulaciones, etc.
                        </span>
                    </label>
                    <input type="file" name="archivos" id="archivos" multiple>
                </div>

                <div class="div8">
                        <label for="riesgos">8. Seleccione si su solicitud conlleva alguno de los siguientes riegos. <br> </label>
                        <input type="checkbox" name="riesgo_rfp_soliciutd" id=""> riesgo. <br>
                        <input type="checkbox" name="riesgo_rfp_soliciutd" id="">riesgo. <br>
                </div>

                <div class="div9"><input id="button-submit" class="button-submit" type="submit" value="Crear Solicitud"></div>
            </form>
        </section>
        <div id="" class="mensaje_submit" >
                        <span>¡Formulario enviado con éxito!</span>
                        <img src="../../../public/images/check-svgrepo-com.svg" alt="" srcset="">
    </div>
    </main>

    <footer> </footer>
</body>

<script src="../index/script.js">
</script>

</html>