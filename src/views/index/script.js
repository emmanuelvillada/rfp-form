
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
const inputFecha = document.getElementById('fecha_requerimiento');
const fechaActual = new Date();
// Sumar 8 días a la fecha actual
fechaActual.setDate(fechaActual.getDate() + 8);

const fechaMinima = fechaActual.toISOString().split('T')[0];
// Establecer la fecha mínima en el input date
inputFecha.setAttribute('min', fechaMinima);

//funcion para que al pasar el mouse por encima de una fecha bloqueada salga un aviso
inputFecha.addEventListener('mouseover', function (event) {
    const fechaSeleccionada = new Date(event.target.value);
    const fechaMinimaObj = new Date(fechaMinima); // Convertir fechaMinima a un objeto Date
    console.log("llega al evento");
    if (fechaSeleccionada < fechaMinimaObj) {
        console.log("llega al alert");
        alert("¡El tiempo mínimo para la negociación de una solicitud son 8 días!");
    }
});

console.log(document.querySelector('input[name="producto_servicio_rfp_solicitud"]:checked').value);

//script para cambiar el mensaje dependiendo de si es suministro o servicio
function cambiarMensaje() {
    var suministroRadio = document.getElementById('suministroRadio');
    var servicioRadio = document.getElementById('servicioRadio');
    var mensajeSpan1 = document.getElementById("ejemplo_span1");
    var mensajeSpan2 = document.getElementById("ejemplo_span2");

    function cambiarMensaje() {
        var opcion_suministro = document.querySelector('input[name="producto_servicio_rfp_solicitud"]:checked').value.toString();
        console.log(opcion_suministro);
        if (opcion === 'suministro') {
            mensajeSpan1.textContent = "Ejemplo de suministro";
            mensajeSpan2.textContent = "suministro";
        } else if (opcion === 'servicio') {
            mensajeSpan1.textContent = "Ejemplo de servicio";
            mensajeSpan2.textContent = "Servicio";
        }
    }

// Llamar a la función una vez para que el mensaje inicial se muestre correctamente
};

suministroRadio.addEventListener('change', cambiarMensaje());
servicioRadio.addEventListener('change', cambiarMensaje());

cambiarMensaje(); 

document.getElementById('detalle_solicitud').setAttribute('placeholder', 'Describa brevemente\nque producto y/o servicio requiere.');