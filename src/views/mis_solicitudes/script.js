function mostrar_form(opcion){
    const form_lista_completa = document.getElementById("form-complete");
    const form_solicitudes_aceptadas = document.getElementById("form-solicitudes-aceptadas");
    const form_solicitudes_rechazadas = document.getElementById("form-solicitudes-rechazadas");
    const form_solicitudes_pendientes = document.getElementById("form_solicitudes_pendientes");

    

    switch (opcion){
        case "solicitudes_aceptadas":
            form_lista_completa.style.display = "none";
            form_solicitudes_aceptadas.style.display = "table";
            break;

        case "solicitudes_rechazadas " :
            form_lista_completa.style.display = "none";
            form_solicitudes_rechazadas.style.display = "table";
            break;

        case "solicitudes_pendientes" :
            form_lista_completa.style.display = "none";
            form_solicitudes_pendientes.style.display = "table";
            break;

        default:
            
            form_lista_completa.style.display = "table";
    }

}