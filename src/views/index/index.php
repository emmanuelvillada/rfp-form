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
        <h1>HWI logo </h1>
        <div class="buttons">
            <a href="src\views\mis_solicitudes\mis_solicitudes.php"><button class="button-mis-solicitudes" >Mis Solicitudes</button></a>
        </div>
    </header>

    <main class="index-container">
        <section class="section">
            <h1>BIENVENIDO A LA APLICACION DE FORMULARIO RFP</h1>
            <p>
                Este formulario está creado con el propósito de ayudar a la creación de una solicitud RFP. Si desea crear una solicitud, diligencie el formulario y presione el botón enviar. Si desea gestionar sus solicitudes, ingrese en el botón Mis Solicitudes.
            </p>
        </section>

        <section class="section">
            <div class="h2-container">
                <h2>FORMULARIO RFP</h2>
            </div>
            <form action="public\controllers\solicitud_controller\SolicitudController.php" method="post">

                <label for="tipo_solicitud">1. Elija si su solicitud es puntual o regular:</label>
                <div class="radio-buttons">
                    <input type="radio" name="tipo_solicitud" value="puntual" id="puntualRadio">
                    <label for="puntualRadio">Puntual</label>
                    <input type="radio" name="tipo_solicitud" value="regular" id="regularRadio">
                    <label for="regularRadio">Regular</label>
                </div>

                <label for="producto_servicio">2. Elija si su solicitud es un suministro o un servicio:</label>
                <div class="radio-buttons">
                    <input type="radio" name="producto_servicio" value="suministro" id="suministroRadio">
                    <label for="suministroRadio">Suministro</label>
                    <input type="radio" name="producto_servicio" value="servicio" id="servicioRadio">
                    <label for="servicioRadio">Servicio</label>
                </div>

                <label for="tipo_presupuesto">3. Elija su tipo de presupuesto:</label>
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

                <label for="detalle_solicitud">4. Detalle el producto y/o servicio que requiere:</label>
                <input type="text" name="detalle_solicitud" id="detalle_solicitud">

                <label for="descripcion_solicitud">5. Describa minuciosamente el producto y/o servicio que requiere:</label>
                <input type="text" name="descripcion_solicitud" id="descripcion_solicitud">

                <label for="requerimiento_solicitud">6. Informe para qué se requiere el producto y/o servicio que requiere:</label>
                <input type="text" name="requerimiento_solicitud" id="requerimiento_solicitud">

                <label for="fecha_requerimiento">7. Indique la fecha para la cual requiere su producto y/o servicio, la fecha debe ser mayor a 8 días desde la fecha actual:</label>
                <input type="date" name="fecha_requerimiento" id="fecha_requerimiento">

                <label for="archivos">8. Adjunte los archivos que considere necesarios para su solicitud:</label>
                <input type="file" name="archivos" id="archivos" multiple>

                <label for="comentario">9. Comentarios:</label>
                <input type="text" name="comentario" id="comentario">

                <input type="submit" value="Crear Solicitud">
            </form>
        </section>
    </main>

    <footer> </footer>
</body>

<script>
    // Script para mostrar las preguntas de presupuesto dependiendo de lo seleccionado en tipo de presupuesto

    const capexRadio = document.getElementById('capexRadio');
    const opexRadio = document.getElementById('opexRadio');
    const sobreejecucionRadio = document.getElementById('sobreejecucionRadio');
    const pregunta1 = document.getElementById('seq_rn');
    const pregunta2 = document.getElementById('ceco');

    // Función para mostrar u ocultar campos según la selección del radio
    function toggleCampos() {
        if (capexRadio.checked) {
            pregunta1.classList.remove('hidden');
            pregunta2.classList.add('hidden');
        } else if (opexRadio.checked) {
            pregunta1.classList.add('hidden');
            pregunta2.classList.remove('hidden');
        } else if (sobreejecucionRadio.checked) {
            pregunta1.classList.add('hidden');
            pregunta2.classList.add('hidden');
        }
    }

    // Agregar event listeners para los radios
    capexRadio.addEventListener('change', toggleCampos);
    opexRadio.addEventListener('change', toggleCampos);
    sobreejecucionRadio.addEventListener('change', toggleCampos);

    // Llamar a la función inicialmente para establecer el estado inicial
    toggleCampos();

    //script para limitar el calendario a una echa de 8 dias

     // Obtener la fecha actual
    const fechaActual = new Date();
    // Sumar 8 días a la fecha actual
    fechaActual.setDate(fechaActual.getDate() + 8);
    
    const fechaMinima = fechaActual.toISOString().split('T')[0];
    // Establecer la fecha mínima en el input date
    document.getElementById('fecha_requerimiento').setAttribute('min', fechaMinima);
</script>

</html>
