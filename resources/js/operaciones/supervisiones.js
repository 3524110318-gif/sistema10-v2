console.log("SUPERVISIONES CARGADO");

document.addEventListener("DOMContentLoaded", () => {

    const asignacion = document.querySelector("#asignacion");

    if (!asignacion) return;

    const servicio = document.querySelector("#info_servicio");
    const plaza = document.querySelector("#info_plaza");
    const turno = document.querySelector("#info_turno");

    function actualizarInformacion() {

        const opcion =
            asignacion.options[
                asignacion.selectedIndex
            ];

        servicio.textContent =
            opcion.dataset.servicio ?? "Seleccione un guardia";

        plaza.textContent =
            opcion.dataset.plaza ?? "Seleccione un guardia";

        turno.textContent =
            opcion.dataset.turno ?? "Seleccione un guardia";
    }

    actualizarInformacion();

    asignacion.addEventListener(
        "change",
        actualizarInformacion
    );

});
