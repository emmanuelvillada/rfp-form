
// Script para mostrar las preguntas de presupuesto dependiendo de lo seleccionado en tipo de presupuesto

const capexRadio = document.getElementById('capexRadio');
const opexRadio = document.getElementById('opexRadio');
const sobreejecucionRadio = document.getElementById('sobreejecucionRadio');
const pregunta1 = document.getElementById('seq_rn');
const pregunta2 = document.getElementById('ceco');
const monto_rfp_presupuesto_seq = document.getElementById('monto_rfp_presupuesto_seq');
const monto_rfp_presupuesto_ceco = document.getElementById('monto_rfp_presupuesto_ceco')

// Función para mostrar u ocultar campos según la selección del radio
function toggleCampos() {
    if (capexRadio.checked) {
        pregunta1.classList.remove('hidden');
        pregunta2.classList.add('hidden');
        monto_rfp_presupuesto_ceco.classList.add('hidden');
        monto_rfp_presupuesto_seq.classList.remove('hidden');
    } else if (opexRadio.checked) {
        pregunta1.classList.add('hidden');
        pregunta2.classList.remove('hidden');
        monto_rfp_presupuesto_seq.classList.add('hidden');
        monto_rfp_presupuesto_ceco.classList.remove('hidden')
    } else if (sobreejecucionRadio.checked) {
        pregunta1.classList.add('hidden');
        pregunta2.classList.add('hidden');
        monto_rfp_presupuesto_ceco.classList.add('hidden');
        monto_rfp_presupuesto_seq.classList.add('hidden');
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
    
    if (fechaSeleccionada < fechaMinimaObj) {
       
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
    var mensajeSpan1_1 = document.getElementById("ejemplo_span1.1");
    var mensajeSpan2_1 = document.getElementById("ejemplo_span2.1");


    var opcion = document.querySelector('input[name="producto_servicio_rfp_solicitud"]:checked').value.toString();

    if (opcion === 'suministro') {
        mensajeSpan1.style.display = "inline";
        mensajeSpan1_1.style.display = "inline";
        mensajeSpan2.style.display = "none";
        mensajeSpan2_1.style.display = "none";
    } else if (opcion === 'servicio') {
        mensajeSpan1.style.display = "none";
        mensajeSpan1_1.style.display = "none";
        mensajeSpan2.style.display = "inline";
        mensajeSpan2_1.style.display = "inline";

    }


    // Llamar a la función una vez para que el mensaje inicial se muestre correctamente
};

suministroRadio.addEventListener('change', cambiarMensaje());
servicioRadio.addEventListener('change', cambiarMensaje());

cambiarMensaje();


//script para que se desabilite el boton de crear solicitud hasta que se llenen todos los campos

function habilitar_submit() {
    var detalle_solicitud = document.getElementById('detalle_solicitud').value.trim();
    var descripcion_solicitud = document.getElementById('descripcion_rfp_solicitud').value.trim();
    var fecha_requerimiento_solicitud = document.getElementById('fecha_requerimiento').value.trim();
    var submitBtn = document.getElementById('button-submit');

    if (detalle_solicitud !== "" && descripcion_solicitud !== "" && fecha_requerimiento_solicitud !== "") {
        submitBtn.disabled = false;
    } else {
        submitBtn.disabled = true;
    }
}

//script para mostrar aviso al enviar el formulario 

document.getElementById("form").addEventListener("submit", function (event) {
    event.preventDefault(); // Evita que se recargue la página al enviar el formulario

    // Mostrar el mensaje si el envío fue exitoso
    var mensaje = document.getElementById("mensaje_submit");
    mensaje.style.display = "block";

    // Ocultar el mensaje después de tres segundos
    setTimeout(function () {
        mensaje.style.display = "none";
    }, 3000); // 3000 milisegundos = 3 segundos

});

//script para modificar el valor del input monto del presupuesto a un formato de dinero.

monto_ceco = document.getElementById('monto_rfp_presupuesto_ceco');
monto_seq = document.getElementById('monto_rfp_presupuesto_seq');

monto_ceco.addEventListener('blur', function() {
    convertir_decimal('monto_rfp_presupuesto_ceco');
});

monto_seq.addEventListener('blur', function() {
    convertir_decimal('monto_rfp_presupuesto_seq');
});

function convertir_decimal(inputId) {
    let inputValue = document.getElementById(inputId).value;
    // Remover caracteres no numéricos y el separador de miles
    let cleanedValue = inputValue.replace(/[^\d.-]/g, '');
    // Convertir a número con dos decimales
    let formattedValue = parseFloat(cleanedValue).toFixed(2);
    // Actualizar el valor del input con el formato deseado
    document.getElementById(inputId).value = formattedValue;
}

