function mostrar_form(opcion){
    const form_lista_completa = document.getElementById("form-complete");
    const form_solicitudes_aceptadas = document.getElementById("form-solicitudes-aceptadas");
    const form_solicitudes_rechazadas = document.getElementById("form-solicitudes-rechazadas");
    const form_solicitudes_pendientes = document.getElementById("form_solicitudes_pendientes");

    if(opcion == "solicitudes_aceptadas"){
        form_solicitudes_aceptadas.style.display = "table";

    }else if (opcion == "solicitudes_rechazadas"){
        form_solicitudes_rechazadas.style.display = "table";

    }else if ( opcion = "")

    switch (opcion){
        case "solicitudes_aceptadas":
            form_solicitudes_aceptadas.style.display = "table";
            break;

        case "solicitudes_rechazadas " :
            form_solicitudes_rechazadas.style.display = "table";
            break;

        case "solicitudes_pendientes" :
            form_solicitudes_pendientes.style.display = "table";
            break;

        default:
            form_lista_completa.style.display = "table";
    }

}