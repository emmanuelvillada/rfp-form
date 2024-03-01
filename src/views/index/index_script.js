
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